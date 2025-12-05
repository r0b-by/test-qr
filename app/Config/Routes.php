<?php

namespace Config;

// Create a new instance of our RouteCollection
$routes = Services::routes();

$routes->get('/', 'BarcodeController::home');
$routes->get('/barcode/show/(:num)', 'BarcodeController::show/$1');
$routes->get('/barcode/file/(:num)', 'BarcodeController::file/$1');
$routes->get('/barcode/generate/(:num)', 'BarcodeController::generate/$1');
