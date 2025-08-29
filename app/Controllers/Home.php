<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Home extends BaseController
{

    protected $product;

    public function __construct()
    {
        $this->product = new ProductModel();
        helper('color_product');
    }

    public function index(): string
    {

        $data['title'] = "Manajemen Stok | Dashboard";
        $data['topbar_name'] = "Dashboard";

        $data['product'] = $this->product->findAll();
        
        return view('home/page_home', $data);
    }
}