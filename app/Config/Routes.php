<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// product
$routes->get('/list-product', 'ProductController::index');
$routes->post('/insert-product', 'ProductController::create');
$routes->post('/insert-qrcode', 'ProductController::create_qr_code');
$routes->post('/get-data-product-by-code', 'ProductController::get_product');
$routes->post('/update-product', 'ProductController::update');
$routes->post('/delete-product', 'ProductController::delete');

// stock
$routes->get('/stock-out', 'StockController::StockOut');
$routes->get('/stock-in', 'StockController::StockIn');
$routes->post('/insert-stok-by-qr', 'StockController::InsertStock');