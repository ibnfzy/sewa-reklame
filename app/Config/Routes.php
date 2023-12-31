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
$routes->get('Lokasi', 'Home::katalog_lokasi');
$routes->get('Lokasi/(:num)', 'Home::katalog_reklame/$1');
$routes->get('Reklame/(:num)', 'Home::reklame/$1');
$routes->post('Proses/(:num)', 'Home::proses_redirect/$1');

$routes->group('Login', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('Admin', 'AdminLogin::index');
    $routes->post('Admin', 'AdminLogin::auth');
    $routes->get('Admin/Destroy', 'AdminLogin::logoff');
    $routes->get('User', 'UserLogin::index');
    $routes->get('Signup', 'UserLogin::signup');
    $routes->post('User', 'UserLogin::auth');
    $routes->post('Signup', 'UserLogin::save_data');
    $routes->get('Destroy', 'UserLogin::logoff');
});

$routes->group('AdminPanel', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'AdmController::index');
    $routes->post('UpdateInformasi', 'AdmController::updateInformasi');
    $routes->post('UpdateTentang', 'AdmController::updateTentang');

    $routes->get('Transaksi', 'AdmController::transaksi');
    $routes->get('Transaksi/(:num)', 'AdmController::transaksi_detail/$1');
    $routes->get('Validasi/(:num)', 'AdmController::validasi_desain/$1');
    $routes->get('ValidasiBBDP/(:num)', 'AdmController::validasibbdp/$1');
    $routes->get('ValidasiLunas/(:num)', 'AdmController::validasilunas/$1');
    $routes->get('PengerjaanSelesai/(:num)', 'AdmController::pengerjaan_selesai/$1');
    $routes->post('UploadDesain/(:num)', 'AdmController::upload_desain/$1');
    $routes->post('UploadDok/(:num)', 'AdmController::upload_dokumentasi/$1');
    $routes->get('Customer', 'AdmController::customer');
    $routes->get('CustKerja/(:num)', 'AdmController::custkerja/$1');
    $routes->get('CustUmum/(:num)', 'AdmController::custumum/$1');
    $routes->get('ValidasiTgl/(:num)', 'AdmController::validasi_tgl/$1');
    $routes->post('UpdateTgl/(:num)', 'AdmController::update_tgl/$1');
    $routes->get('LanjutTransaksi/(:num)', 'AdmController::lanjut_transaksi/$1');

    $routes->get('laporan_cust', 'AdmController::laporan_cust');
    $routes->get('laporan_transaksi', 'AdmController::laporan_transaksi');
    $routes->post('laporan_transaksi', 'AdmController::render_laporan_transaksi');

    $routes->get('Corousel', 'Corousel::index');
    $routes->post('Corousel', 'Corousel::create');
    $routes->get('Corousel/new', 'Corousel::new');
    $routes->get('Corousel/delete/(:num)', 'Corousel::delete/$1');

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
    $routes->get('Transaksi', 'UserController::transaksi_bs');
    $routes->get('TransaksiO', 'UserController::transaksi');
    $routes->get('Transaksi_', 'UserController::transaksi_selesai');
    $routes->get('Transaksi/(:num)', 'UserController::transaksi_detail/$1');
    $routes->get('Proses/(:num)', 'UserController::proses_transaksi/$1');
    $routes->get('Delete/(:num)', 'UserController::batal_tranasksi/$1');
    $routes->post('JenisDesain/(:num)', 'UserController::jenis_penyerahan/$1');
    $routes->post('UploadSendiri/(:num)', 'UserController::upload_desain_sendiri/$1');
    $routes->post('UploadBBDP/(:num)', 'UserController::uploadBBDP/$1');
    $routes->post('UploadBBDPS/(:num)', 'UserController::uploadBBDPS/$1');
    $routes->post('UploadLunas/(:num)', 'UserController::uploadLunas/$1');
    $routes->post('UploadKriteria/(:num)', 'UserController::uploadKriteriaDesain/$1');
    $routes->get('TerimaDesain/(:num)', 'UserController::terima_desain/$1');
    $routes->post('UploadRevisi/(:num)', 'UserController::upload_revisi/$1');
    $routes->post('Testimoni/(:num)', 'UserController::testimoni_add/$1');
    $routes->get('Testimoni/(:num)', 'UserController::testimoni_delete/$1');
    $routes->get('Testimoni', 'UserController::testimoni');
    $routes->post('Informasi', 'UserController::informasi_update');
    $routes->post('Password', 'UserController::password_update');
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