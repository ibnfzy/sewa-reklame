<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->group('Login', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('Admin', 'AdminLogin::index');
    $routes->post('Admin', 'AdminLogin::auth');
    $routes->get('Admin/Destroy', 'AdminLogin::logoff');
    $routes->get('User', 'UserLogin::index');
    $routes->get('Signup', 'UserLogin::signup');
    $routes->post('User', 'UserLogin::auth');
    $routes->post('Signup', 'UserLogin::save_data');
});

$routes->group('AdminPanel', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'AdmController::index');
    $routes->get('transaksi', 'AdmController::transaksi');
    $routes->get('laporan_cust', 'AdmController::laporan_cust');
    $routes->get('laporan_transaksi', 'AdmController::laporan_transaksi');

    $routes->get('Reklame', 'Reklame::index');
    $routes->post('Reklame', 'Reklame::create');
    $routes->get('Reklame/(:num)', 'Reklame::edit/$1');
    $routes->post('Reklame/(:num)', 'Reklame::update/$1');
    $routes->get('Reklame/add', 'Reklame::add');
    $routes->get('Reklame/delete/(:num)', 'Reklame::delete/$1');

    $routes->get('LokasiReklame', 'LokasiReklame::index');
    $routes->post('LokasiReklame', 'LokasiReklame::create');
    $routes->get('LokasiReklame/(:num)', 'LokasiReklame::edit/$1');
    $routes->post('LokasiReklame/(:num)', 'LokasiReklame::update/$1');
    $routes->get('LokasiReklame/add', 'LokasiReklame::add');
    $routes->get('LokasiReklame/delete/(:num)', 'LokasiReklame::delete/$1');
});

$routes->group('Panel', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'UserController::index');
    $routes->get('');
});

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}