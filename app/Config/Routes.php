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
$routes->get('tes', 'Home::tes');
$routes->get('dashboard', 'Home::dashboard');
$routes->get('pendaftar', 'Home::pendaftar');
$routes->get('berkas', 'Home::berkas');

$routes->group('ubah', function ($routes) {
    $routes->post('datamasuk', 'Pendaftar::ubahdatamasuk');
    $routes->post('datanilai', 'Pendaftar::ubahdatanilai');
    $routes->post('datanilai2', 'Pendaftar::ubahdatanilai2');
    $routes->post('datapribadi', 'Pendaftar::ubahdatapribadi');
    $routes->get('datapribadi', 'Pendaftar::ubahdatapribadi1');
    $routes->get('berkas/hapus/(:any)', 'Pendaftar::hapusberkas/$1');
});

$routes->group('tambah', function ($routes) {
    $routes->post('berkas', 'Pendaftar::tambahberkas');
});

$routes->match(['get', 'post'], 'login', 'Auth::login');
$routes->match(['get', 'post'], 'daftar', 'Auth::daftar');
$routes->get('logout', 'Auth::logout');

$routes->group('admin', function ($routes) {
    $routes->get('/', 'Admin\Home::index');
    $routes->get('berkastercabut', 'Admin\Pendaftar::berkas_tercabut');

    $routes->match(['get', 'post'], 'login', 'Admin\Auth::login');
    $routes->get('logout', 'Admin\Auth::logout');

    $routes->group('pendaftar', function ($routes) {
        $routes->get('/', 'Admin\Pendaftar::index');
        $routes->get('tes', 'Admin\Pendaftar::tes');
        $routes->get('detail/(:any)', 'Admin\Pendaftar::detail/$1');
        $routes->get('berkas/(:any)', 'Admin\Pendaftar::berkas/$1');
        $routes->get('cetak/(:any)', 'Admin\Pendaftar::cetak/$1');

        $routes->group('ubah', function ($routes) {
            $routes->post('datamasuk', 'Admin\Pendaftar::ubahdatamasuk');
            $routes->post('datanilai2', 'Admin\Pendaftar::ubahdatanilai2');
            $routes->post('datapribadi', 'Admin\Pendaftar::ubahdatapribadi');

            $routes->group('berkas', function ($routes) {
                $routes->get('hapus/(:any)', 'Admin\Pendaftar::hapusberkas/$1');
                $routes->get('cabut/(:any)', 'Admin\Pendaftar::cabutberkas/$1');
                $routes->get('cabutpermanen', 'Admin\Pendaftar::cabutberkas_permanen');
                $routes->get('balik/(:any)', 'Admin\Pendaftar::balikberkas/$1');

                $routes->group('status', function ($routes) {
                    $routes->get('terverifikasi/(:any)', 'Admin\Pendaftar::updstatusberkas/$1/1');
                    $routes->get('ditolak/(:any)', 'Admin\Pendaftar::updstatusberkas/$1/2');
                });
            });
        });

        $routes->group('tambah', function ($routes) {
            $routes->post('berkas', 'Admin\Pendaftar::tambahberkas');
        });

        $routes->get('hapus/(:any)', 'Admin\Pendaftar::hapus/$1');
    });

    $routes->group('angkatan', function ($routes) {
        $routes->get('get/(:any)', 'Admin\Angkatan::get/$1');
        $routes->post('tambah', 'Admin\Angkatan::tambah');
        $routes->post('ubah/(:any)', 'Admin\Angkatan::tambah/$1'); // ubah
        $routes->get('hapus/(:any)', 'Admin\Angkatan::hapus/$1');
    });

    $routes->group('laporan', function ($routes) {
        $routes->get('/', 'Admin\Laporan::index');
    });
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
