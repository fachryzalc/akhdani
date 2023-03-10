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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/auth/register', 'Auth::register');

$routes->get('/kota/edit/(:segment)', 'Kota::edit/$1');
$routes->delete('/kota/(:num)', 'Kota::hapus/$1');
$routes->get('/kota/tambah', 'Kota::tambah');
$routes->get('/kota/(:any)', 'Kota::index');
$routes->get('/kota', 'Kota::index');

$routes->get('/user/edit/(:segment)', 'User::edit/$1');
$routes->delete('/user/(:num)', 'User::hapus/$1');
$routes->get('/user/tambah', 'User::tambah');
$routes->get('/user/(:any)', 'User::index');

$routes->get('/perdin/reject/(:num)', 'Perdin::reject/$1');
$routes->get('/perdin/approve/(:num)', 'Perdin::approve/$1');
$routes->get('/perdin/detail/(:num)', 'Perdin::detail/$1');
$routes->get('/perdin/sdm', 'Perdin::sdm');

$routes->get('/perdin/edit/(:segment)', 'Perdin::edit/$1');
$routes->delete('/perdin/(:num)', 'Perdin::hapus/$1');
$routes->get('/perdin/tambah', 'Perdin::tambah');
$routes->get('/perdin/pegawai/(:num)', 'Perdin::pegawai/$1');
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
