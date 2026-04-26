<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// Rute untuk menampilkan halaman Form Registrasi
$routes->get('/register', 'Auth::register');

// Rute untuk memproses data saat tombol "Daftar Sekarang" ditekan
$routes->post('/auth/processRegister', 'Auth::processRegister');

// Rute untuk halaman form login
$routes->get('/login', 'Auth::login');

// Rute untuk memproses data saat tombol "Masuk" ditekan
$routes->post('/auth/processLogin', 'Auth::processLogin');

// Rute sementara untuk halaman setelah berhasil login
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/logout', 'Auth::logout');
// Rute untuk Manajemen Jasa (Hanya untuk Freelancer)
$routes->get('/services/create', 'Service::create');
$routes->post('/services/store', 'Service::store');
// Rute untuk Edit Jasa
$routes->get('/services/edit/(:num)', 'Service::edit/$1');
$routes->post('/services/update/(:num)', 'Service::update/$1');
// Rute untuk Sistem Order dan Chat
$routes->post('/order/create', 'Order::create');
$routes->get('/chat/(:num)', 'Order::chatRoom/$1');
$routes->post('/chat/send/(:num)', 'Order::sendMessage/$1');
// Rute untuk mengambil pesan secara Real-Time (AJAX)
$routes->get('/chat/load/(:num)', 'Order::loadMessages/$1');
// Rute Halaman Detail Jasa
$routes->get('/service/(:num)', 'Service::detail/$1');
// Rute Profil
$routes->get('/profile', 'Profile::index');
$routes->post('/profile/update', 'Profile::update');

// Rute Update Status Order
$routes->post('/order/updateStatus/(:num)', 'Order::updateStatus/$1');
// Rute untuk Panel Member (Sidebar Gelap)
$routes->get('/panel', 'Dashboard::panel');
// Rute Admin
$routes->get('/admin', 'Admin::index');