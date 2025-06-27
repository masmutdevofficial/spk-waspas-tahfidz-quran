<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/hasil-penilaian', 'Home::hasil');

$routes->get('/login', 'Home::login', ['filter' => 'noauth']);
$routes->post('/logout', 'Home::logout');

$routes->post('/login/proses', 'Home::proses', ['filter' => 'noauth']);

$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('data-kriteria', 'Kriteria::index');
    $routes->post('kriteria/tambah', 'Kriteria::tambah');
    $routes->post('kriteria/update/(:num)', 'Kriteria::update/$1');
    $routes->post('kriteria/delete/(:num)', 'Kriteria::delete/$1');

    $routes->get('data-siswa', 'Siswa::index');
    $routes->post('siswa/tambah', 'Siswa::tambah');
    $routes->post('siswa/update/(:num)', 'Siswa::update/$1');
    $routes->post('siswa/delete/(:num)', 'Siswa::delete/$1');

    $routes->get('data-user', 'User::index');
    $routes->post('user/tambah', 'User::tambah');
    $routes->post('user/update/(:num)', 'User::update/$1');
    $routes->post('user/delete/(:num)', 'User::delete/$1');

    $routes->get('penilaian', 'Penilaian::index');
    $routes->post('penilaian/tambah', 'Penilaian::tambah');
    $routes->post('penilaian/update/(:num)', 'Penilaian::update/$1');
    $routes->post('penilaian/delete/(:num)', 'Penilaian::delete/$1');
    $routes->get('mulai-algoritma', 'Penilaian::algoritmaWaspas');

    $routes->get('hasil-penilaian', 'Hasil::index');
    $routes->post('hasil-penilaian/tambah', 'Hasil::tambah');
    $routes->post('hasil-penilaian/update/(:num)', 'Hasil::update/$1');
    $routes->post('hasil-penilaian/delete/(:num)', 'Hasil::delete/$1');
    $routes->get('grafik-penilaian', 'Hasil::grafik');
    $routes->get('cetak-hasil-penilaian', 'Hasil::cetakHasil');

    $routes->get('grafik-kriteria', 'Grafik::index');
    $routes->get('grafik-kriteria-pie', 'Grafik::pieData');
});