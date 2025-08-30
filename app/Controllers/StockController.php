<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\StockManajementModel;
use App\Models\ProductModel;

class StockController extends BaseController
{
    protected $stockManajement;

    public function __construct()
    {
        $this->stockManajement = new StockManajementModel();
        helper('color_product');
        helper('date_format_helper');
    }

    public function StockOut()
    {
        $data['title'] = "Manajemen Stok | Stock Out";
        $data['topbar_name'] = "Stok Keluar";
        
        $data['stock'] = $this->stockManajement
        ->select('StockManajement.*, ListProduct.ProductName')
        ->join('ListProduct', 'ListProduct.ProductCode = StockManajement.ProductCode', 'left')
        ->where("TypeStock" , 1)
        ->orderBy('StockManajement.created_at', 'DESC')
        ->findAll();

        $data['stock_type'] = "Keluar";
        
        return view('stock/page_stock', $data);data: 
    }

    public function StockIn()
    {
        $data['title'] = "Manajemen Stok | Stock In";
        $data['topbar_name'] = "Stok Masuk";

        $data['stock_type'] = "Masuk";
        
        $data['stock'] = $this->stockManajement
        ->select('StockManajement.*, ListProduct.ProductName')
        ->join('ListProduct', 'ListProduct.ProductCode = StockManajement.ProductCode', 'left')
        ->where("TypeStock" , 2)
        ->orderBy('StockManajement.created_at', 'DESC')
        ->findAll();
        
        return view('stock/page_stock', $data);data: 
    }

    public function InsertStock()
    {
        $product_code = $this->request->getPost('qr_code');
        $stock_type = $this->request->getPost('stock_type');
        $qty = $this->request->getPost('qty');

        $data_create = [
            "ProductCode" => $product_code,
            "TypeStock" => ($stock_type == "Keluar") ? 1 : 2,
            "Qty" => $qty,
            "DateInput" => date('Y-m-d H:i:s')
        ];

        $create = $this->stockManajement->insert($data_create);

        $dataStockNow = new ProductModel();

        $stockNow = $dataStockNow->select('TotalStock')
        ->where('ProductCode', $product_code)
        ->first();
        // kurangin atau tambah stock
        if($stock_type == "Keluar") {
            $stockAkhir = $stockNow['TotalStock'] - $qty;
        } else {
            $stockAkhir = $stockNow['TotalStock'] + $qty;
        }

        $dataStockNow->set('TotalStock', $stockAkhir)
                 ->where('ProductCode', $product_code)
                 ->update();
                 
        if ($create) {
            $status = true;
            $message = "Data stok berhasil disimpan";
        } else {
            $status = true;
            $message = "Data stok berhasil disimpan";
        }

        return $this->response->setJSON([
            'status'  => $status,
            'message' => $message
        ]);
    }
}