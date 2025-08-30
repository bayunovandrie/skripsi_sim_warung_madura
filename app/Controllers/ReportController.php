<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\StockManajementModel;

class ReportController extends BaseController
{
    protected $reportStock;

    public function __construct()
    {
        $this->reportStock = new StockManajementModel();
        helper('color_product');
    }
    public function index()
    {
        $data['title'] = "Manajemen Stok | Laporan Barang";
        $data['topbar_name'] = "Laporan";
        $dnow = date('Y-m-d');

        $from = $this->request->getPost('from');
        $until = $this->request->getPost('until');

        $query = $this->reportStock->select('stockmanajement.*, listproduct.ProductName') // ambil kolom tambahan
        ->join('listproduct', 'listproduct.ProductCode = stockmanajement.ProductCode', 'left');

        if(isset($from)) {
            $query = $query->where('DATE(DateInput) >=', $from)
                   ->where('DATE(DateInput) <=', $until);
        } else {
            $query = $query->where('DATE(DateInput) =', $dnow);
        }

        $data['history'] = $query->findAll();

        return view('report/page_report', $data);data:
    }
}