<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');
$routes->get('data-kriteria', 'Kriteria::index');
$routes->get('data-siswa', 'Siswa::index');
$routes->get('data-user', 'User::index');
$routes->get('penilaian', 'Penilaian::index');
$routes->get('hasil-penilaian', 'Hasil::index');
$routes->get('grafik-kriteria', 'Grafik::index');
