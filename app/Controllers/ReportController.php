<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\StockManajementModel;
use App\Models\ProductModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ReportController extends BaseController
{
    protected $reportStock;
    protected $dataProduct;

    public function __construct()
    {
        $this->reportStock = new StockManajementModel();
        $this->dataProduct = new ProductModel();
        helper('color_product');
    }
    public function index()
    {
        $data['title'] = "Manajemen Stok | Laporan Barang";
        $data['topbar_name'] = "Laporan";
        $dnow = date('Y-m-d');

        $from = $this->request->getPost('from');
        $until = $this->request->getPost('until');

        $query = $this->reportStock->select('StockManajement.*, ListProduct.ProductName') // ambil kolom tambahan
        ->join('ListProduct', 'ListProduct.ProductCode = StockManajement.ProductCode', 'left');

        if(isset($from)) {
            $query = $query->where('DATE(DateInput) >=', $from)
                   ->where('DATE(DateInput) <=', $until);
        } else {
            $query = $query->where('DATE(DateInput) =', $dnow);
        }

        $data['history'] = $query->findAll();

        return view('report/page_report', $data);data:
    }

    public function export_excel()
    {

        $data = $this->reportStock->select('StockManajement.*, ListProduct.ProductName')->join('ListProduct', 'ListProduct.ProductCode = StockManajement.ProductCode', 'left')->findAll();

        $dataProduct = $this->dataProduct->findAll();

        // echo json_encode($dataProduct);
        // die;

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // =======================
        //  TITLE
        // =======================
        $title = "Report Stock Barang";
        $sheet->setCellValue('A1', $title);
        $sheet->mergeCells('A1:H1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Tanggal Export
        $sheet->setCellValue('A2', 'Tanggal Export: ' . date('d-m-Y H:i'));
        $sheet->mergeCells('A2:H2');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // =======================
        //  HEADER
        // =======================
        $sheet->setCellValue('A4', 'No');
        $sheet->setCellValue('B4', 'Nama Barang');
        $sheet->setCellValue('C4', 'Jumlah Stok');
        $sheet->setCellValue('D4', 'Tipe Stok');
        $sheet->setCellValue('E4', 'Tanggal Pengimputan');

        // Styling Header
        $headerStyle = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => 'D9D9D9']
            ],
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN]
            ]
        ];
        $sheet->getStyle('A4:E4')->applyFromArray($headerStyle);

        // =======================
        //  ISI DATA
        // =======================
        $row = 5;
        $no = 1;

        foreach ($data as $item) {

            $tipeStock = ($item['TypeStock'] == 1) ? "Stok Keluar" : "Stok Masuk";
            $qty = ($item['TypeStock'] == 1) ? "-" . $item['Qty'] : "+" . $item['Qty'];

            $originalDate = $item['DateInput']; // 2025-08-30 14:58:33
            $timestamp = strtotime($originalDate);

            $hariList = [
                'Sunday' => 'Minggu',
                'Monday' => 'Senin',
                'Tuesday' => 'Selasa',
                'Wednesday' => 'Rabu',
                'Thursday' => 'Kamis',
                'Friday' => 'Jumat',
                'Saturday' => 'Sabtu'
            ];

            $hariInggris = date('l', $timestamp);
            $hariID = $hariList[$hariInggris];

            // Nama bulan Indonesia
            $bulanList = [
                1 => 'Januari',
                2 => 'Februari',
                3 => 'Maret',
                4 => 'April',
                5 => 'Mei',
                6 => 'Juni',
                7 => 'Juli',
                8 => 'Agustus',
                9 => 'September',
                10 => 'Oktober',
                11 => 'November',
                12 => 'Desember'
            ];

            $bulanID = $bulanList[date('n', $timestamp)];

            // Format akhir
            $formattedDate = $hariID . ', ' . date('d', $timestamp) . ' - ' . $bulanID . ' - ' . date('Y H:i', $timestamp) . ' WIB';

            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $item['ProductName']);
            $sheet->setCellValue('C' . $row, $qty);
            $sheet->setCellValue('D' . $row, $tipeStock);
            $sheet->setCellValue('E' . $row, $formattedDate);

            // Warna teks stok masuk/keluar
            if ($item['TypeStock'] == 1) {
                // Stok Keluar → merah
                $sheet->getStyle('C' . $row)->getFont()->getColor()->setRGB('FF0000');
                $sheet->getStyle('D' . $row)->getFont()->getColor()->setRGB('FF0000');
            } else {
                // Stok Masuk → hijau
                $sheet->getStyle('C' . $row)->getFont()->getColor()->setRGB('008000');
                $sheet->getStyle('D' . $row)->getFont()->getColor()->setRGB('008000');
            }


            $row++;
        }

        // Border seluruh tabel
        $sheet->getStyle("A4:E" . ($row - 1))->applyFromArray([
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN]
            ]
        ]);

        // =======================
        //  AUTO WIDTH
        // =======================
        foreach (range('A', 'E') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $startRowRight = 4;

        $sheet->setCellValue('G' . $startRowRight, 'Nama Barang');
        $sheet->setCellValue('H' . $startRowRight, 'Total Stok Akhir');

        $sheet->getStyle("G{$startRowRight}:H{$startRowRight}")->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => 'D9D9D9']
            ],
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN]
            ]
        ]);

        // =======================
        //  ISI DATA TABEL KANAN
        // =======================

        // Row untuk isi data
        $rowRight = $startRowRight + 1;

        // Misal data stok akhir beda array:
        // contoh: $dataTotalStock = $this->reportStock->getFinalStock();
        foreach ($dataProduct as $item) {

            $sheet->setCellValue('G' . $rowRight, $item['ProductName']);
            $sheet->setCellValue('H' . $rowRight, $item['TotalStock']);

            $rowRight++;
        }

        // Border seluruh tabel kanan
        $sheet->getStyle("G{$startRowRight}:H" . ($rowRight - 1))->applyFromArray([
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN]
            ]
        ]);

        // Auto width tabel kanan
        foreach (range('G', 'H') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // =======================
        //  EXPORT FILE
        // =======================
        $filename = 'report_stock_' . date('Ymd_His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=$filename");
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}