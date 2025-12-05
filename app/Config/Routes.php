<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'BarcodeController::index');
$routes->post('/barcode/upload', 'BarcodeController::upload');
$routes->get('/barcode/show/(:num)', 'BarcodeController::show/$1');
$routes->get('/barcode/generate/(:num)', 'BarcodeController::generate/$1');
$routes->get('/barcode/file/(:num)', 'BarcodeController::file/$1');

