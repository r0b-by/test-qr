<?php

namespace Config;

// Create a new instance of our RouteCollection
$routes = Services::routes();

// Load the system's routing file first
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * Router Setup
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * Route Definitions
 */
$routes->get('/', 'BarcodeController::home');
$routes->get('/barcode/show/(:num)', 'BarcodeController::show/$1');
$routes->get('/barcode/file/(:num)', 'BarcodeController::file/$1');
$routes->get('/barcode/generate/(:num)', 'BarcodeController::generate/$1');

/*
 * Additional Routing
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}