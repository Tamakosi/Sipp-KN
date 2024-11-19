<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('menu', 'MenuController::index');
$routes->get('menu/create', 'MenuController::create');
$routes->post('menu/save', 'MenuController::save');
$routes->get('menu/edit/(:segment)', 'MenuController::edit/$1');
$routes->post('menu/update/(:segment)', 'MenuController::update/$1');
$routes->get('menu/delete/(:segment)', 'MenuController::delete/$1');
$routes->get('pelanggan', 'PelangganController::index');
$routes->get('pelanggan/create', 'PelangganController::create');
$routes->post('pelanggan/save', 'PelangganController::save');
$routes->get('pelanggan/edit/(:segment)', 'PelangganController::edit/$1');
$routes->post('pelanggan/update/(:segment)', 'PelangganController::update/$1');
$routes->get('pelanggan/delete/(:segment)', 'PelangganController::delete/$1');
$routes->get('karyawan', 'KaryawanController::index');
$routes->get('karyawan/create', 'KaryawanController::create');
$routes->post('karyawan/save', 'KaryawanController::save');
$routes->get('karyawan/edit/(:segment)', 'KaryawanController::edit/$1');
$routes->post('karyawan/update/(:segment)', 'KaryawanController::update/$1');
$routes->get('karyawan/delete/(:segment)', 'KaryawanController::delete/$1');
$routes->get('transaksi', 'TransaksiController::index');
$routes->get('transaksi/create', 'TransaksiController::create');
$routes->post('transaksi/store', 'TransaksiController::store');
$routes->get('transaksi/detail/(:segment)', 'TransaksiController::detail/$1');
$routes->get('transaksi/edit/(:segment)', 'TransaksiController::edit/$1');
$routes->post('transaksi/update/(:segment)', 'TransaksiController::update/$1');
$routes->get('transaksi/delete/(:segment)', 'TransaksiController::delete/$1');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
