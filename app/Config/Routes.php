<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Rute untuk Aplikasi Web

$routes->get('/', 'Home::index');

$routes->group('Web', ['namespace' => 'App\Controllers\Web'], function ($routes) {
    $routes->get('pegawai', 'pegawaiController::index',  ['filter' => 'role:admin,superadmin']);
    $routes->get('pegawai/create', 'PegawaiController::create',  ['filter' => 'role:admin']);
    $routes->post('pegawai/store', 'PegawaiController::store',  ['filter' => 'role:admin']);
    // $routes->get('pegawai/edit/(:num)', 'PegawaiController::edit/$1',  ['filter' => 'role:admin']);
    $routes->get('pegawai/edit/(:num)', 'PegawaiController::update_data/$1');
    $routes->post('pegawai/update/(:num)', 'PegawaiController::update/$1',  ['filter' => 'role:admin']);
    $routes->delete('pegawai/delete/(:num)', 'PegawaiController::delete/$1',  ['filter' => 'role:admin']);

    $routes->get('pelanggan', 'PelangganController::index');
    $routes->get('pelanggan/create/', 'PelangganController::create');
    $routes->post('pelanggan/store', 'PelangganController::store');
    $routes->get('pelanggan/edit/(:num)', 'PelangganController::update_data/$1');
    $routes->post('pelanggan/update/(:num)', 'PelangganController::update/$1');
    $routes->delete('pelanggan/delete/(:num)', 'PelangganController::delete/$1');

    $routes->get('jenislayanan', 'JenislayananController::index');
    $routes->get('jenislayanan/create/', 'JenislayananController::create');
    $routes->post('jenislayanan/store', 'JenislayananController::store');
    $routes->get('jenislayanan/edit/(:num)', 'JenislayananController::update_data/$1');
    $routes->post('jenislayanan/update/(:num)', 'JenislayananController::update/$1');
    $routes->delete('jenislayanan/delete/(:num)', 'JenislayananController::delete/$1');

    $routes->get('transaksilayanan', 'TransaksiLayananController::index');
    $routes->get('transaksilayanan/create/', 'TransaksiLayananController::create');
    $routes->post('transaksilayanan/store', 'TransaksiLayananController::store');
    $routes->get('transaksilayanan/edit/(:num)', 'TransaksiLayananController::edit/$1');
    $routes->post('transaksilayanan/update/(:num)', 'TransaksiLayananController::update/$1');
    $routes->delete('transaksilayanan/delete/(:num)', 'TransaksiLayananController::delete/$1');

    $routes->get('transaksi', 'TransaksiController::index');
    $routes->get('transaksi/create', 'TransaksiController::create');
    $routes->post('transaksi/store', 'TransaksiController::store');
    $routes->get('transaksi/edit/(:num)', 'TransaksiController::update_data/$1');
    $routes->post('transaksi/update/(:num)', 'TransaksiController::update/$1');
    $routes->delete('transaksi/delete/(:num)', 'TransaksiController::delete/$1',  ['filter' => 'role:admin,superadmin']);
    $routes->get('transaksi/export', 'TransaksiController::export',  ['filter' => 'role:admin,superadmin']);
});


// Rute untuk API
$routes->group('API', ['namespace' => 'App\Controllers\API'], function ($routes) {
    $routes->get('pegawai', 'pegawaiController::index');
    $routes->post('pegawai/create/', 'PegawaiController::create');
    $routes->post('pegawai/update/(:num)', 'PegawaiController::update/$1');
    $routes->delete('pegawai/delete/(:num)', 'PegawaiController::delete/$1');

    $routes->get('pelanggan', 'PelangganController::index');
    // $routes->get('pelanggan/test', 'PelangganController::index');
    $routes->post('pelanggan/create/', 'PelangganController::create');
    $routes->post('pelanggan/login', 'PelangganController::login');
    $routes->post('pelanggan/update/(:num)', 'PelangganController::update/$1');
    $routes->delete('pelanggan/delete/(:num)', 'PelangganController::delete/$1');

    $routes->get('jenislayanan', 'JenisLayananController::index');
    $routes->get('jenislayanan/(:num)', 'JenisLayananController::show/$1'); // Add this line for the show method
    $routes->post('jenislayanan/create', 'JenisLayananController::create');
    $routes->post('jenislayanan/update/(:num)', 'JenisLayananController::update/$1');
    $routes->delete('jenislayanan/delete/(:num)', 'JenisLayananController::delete/$1');

    $routes->get('transaksi', 'TransaksiController::index');
    $routes->post('transaksi/create/', 'TransaksiController::create');
    $routes->post('transaksi/update/(:num)', 'TransaksiController::update/$1');
    $routes->delete('transaksi/delete/(:num)', 'TransaksiController::delete/$1');
    $routes->get('transaksi/customer/(:segment)', 'TransaksiController::getByCustomerId/$1');
    $routes->put('transaksi/(:num)/keluhan', 'TransaksiController::updateKeluhan/$1');;
});
