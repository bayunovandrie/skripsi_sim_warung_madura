<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\StockManajementModel;

class Home extends BaseController
{

    protected $product;
    protected $stock;

    public function __construct()
    {
        $this->product = new ProductModel();
        $this->stock = new StockManajementModel();
        helper('color_product');
    }

    public function index(): string
    {

        $data['title'] = "Manajemen Stok | Dashboard";
        $data['topbar_name'] = "Dashboard";

        $data['product'] = $this->product->findAll();

        $totalStock = $this->product
        ->selectSum('TotalStock')
        ->get()
        ->getRow()
        ->TotalStock;

        $stock = $this->stock->findAll();

        

        $stockKeluar = 0;
        $stockMasuk = 0;

        foreach($stock as $val) {

            // stock keluar
            if($val['TypeStock'] == 1) {
                $stockKeluar+=$val['Qty'];
            }  else {
                $stockMasuk+=$val['Qty'];
            }
        }

        $data['return'] = [
            "StockMasuk" => $stockMasuk,
            "StockKeluar" => $stockKeluar,
            "TotalStock" => $totalStock
        ];

        // echo json_encode(value: $totalStock);
        // die;
        
        return view('home/page_home', $data);
    }
}