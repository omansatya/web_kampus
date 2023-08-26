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
$routes->get('galeri', 'galeri::index');
$routes->get('prestasi', 'prestasi::index');
$routes->get('kontak', 'kontak::index');
$routes->get('profil', 'profil::index');

$routes->add('admin/logout', 'Admin\admin::logout');

$routes->group('admin',['filter'=>'noauth'], function ($routes){
    $routes->add('login', 'admin\admin::login');
    $routes->add('lupapassword', 'admin\admin::lupapassword');
    $routes->add('resetpassword', 'admin\admin::resetpassword');
    
});

$routes->group('admin',['filter'=>'auth'], function ($routes){
    $routes->add('sukses', 'Admin\admin::sukses');
    $routes->add('article', 'Admin\article::index');
    
    
    $routes->add('akun', 'Admin\Akun::index');
    
    $routes->add('prestasi', 'Admin\Prestasi::index');
    $routes->add('prestasi/tambah', 'Admin\Prestasi::tambah');
    $routes->post('prestasi/simpan', 'Admin\Prestasi::simpan');

    $routes->get('prestasi/edit/(:num)', 'Admin\Prestasi::edit/$1');
    $routes->get('prestasi/edit/(:num)', 'Admin\Prestasi::edit/$1');
    $routes->post('prestasi/edit/(:num)', 'Admin\Prestasi::edit/$1');

    
    $routes->post('prestasi/update', 'Admin\Prestasi::update');
    $routes->get('prestasi/delete/(:num)', 'Admin\Prestasi::delete/$1');


    $routes->get('prodi', 'Admin\prodi::index');
    $routes->get('prodi/tambah', 'Admin\prodi::tambah');
    $routes->add('prodi/tambah', 'Admin\prodi::tambah');
    $routes->get('prodi/edit/(:num)', 'Admin\prodi::edit/$1');
    $routes->post('prodi/edit/(:num)', 'Admin\Prodi::edit/$1');
    $routes->post('prodi/update', 'prodi::update');
    $routes->get('prodi/delete/(:num)', 'Admin\prodi::delete/$1');

    $routes->get('alumni', 'Admin\alumni::index');
    $routes->get('alumni/tambah', 'Admin\alumni::tambah');
    $routes->get('admin/alumni/tambah', 'Admin\Alumni::tambah');
    $routes->post('alumni/tambah', 'Admin\Alumni::tambah');
    $routes->get('alumni/edit/(:num)', 'Admin\Alumni::edit/$1');
    $routes->post('alumni/edit/(:num)', 'Admin\Alumni::edit/$1');
    $routes->get('alumni/delete/(:num)', 'Admin\alumni::delete/$1');
    
    $routes->get('galeri', 'Admin\galeri::index');
    $routes->get('galeri/tambah', 'Admin\galeri::tambah');
    $routes->get('admin/galeri/tambah', 'Admin\galeri::tambah');
    $routes->post('galeri/tambah', 'Admin\galeri::tambah');
    $routes->get('galeri/edit/(:num)', 'Admin\galeri::edit/$1');
    $routes->post('galeri/edit/(:num)', 'Admin\galeri::edit/$1');
    $routes->get('galeri/delete/(:num)', 'Admin\galeri::delete/$1');

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
