<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProductModel;

class ProfileController extends BaseController
{
    protected $product;

    public function __construct()
    {
        $this->product = new ProductModel();
        helper('color_product');
    }
    public function index()
    {
        $data['title'] = "Manajemen Stok | Product";
        $data['topbar_name'] = "Product";

        $data['product'] = $this->product->findAll();
        
        return view('product/page_product', $data);data:
    }
}