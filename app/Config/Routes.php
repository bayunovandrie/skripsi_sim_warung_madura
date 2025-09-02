<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', function() {
    return redirect()->to('/logout');
});


$routes->get('get-data-product', 'Home::getProduct');

// Admin routes
$routes->group('admin', ['filter' => 'role:admin'], function($routes) {
    $routes->get('home', 'Home::index');
    
    // user
    $routes->get('profile', 'ProfileController::index');
    $routes->post('insert-users', 'ProfileController::create');
    $routes->post('update-users', 'ProfileController::update');
    $routes->post('delete-users', 'ProfileController::delete');
});

// User routes
$routes->group('user', ['filter' => 'role:user'], function($routes) {
    $routes->get('home', 'Home::index');
    $routes->get('profile', 'ProfileController::index');

    // product
    $routes->get('list-product', 'ProductController::index');
    $routes->post('insert-product', 'ProductController::create');
    $routes->post('insert-qrcode', 'ProductController::create_qr_code');
    $routes->post('get-data-product-by-code', 'ProductController::get_product');
    $routes->post('update-product', 'ProductController::update');
    $routes->post('delete-product', 'ProductController::delete');

    // stock
    $routes->get('stock-out', 'StockController::StockOut');
    $routes->get('stock-in', 'StockController::StockIn');
    $routes->post('insert-stok-by-qr', 'StockController::InsertStock');

    //  profile
    $routes->get('profile', 'ProfileController::index');

    //  report
    $routes->get('report-item', 'ReportController::index');
    $routes->post('report-item', 'ReportController::index');
});