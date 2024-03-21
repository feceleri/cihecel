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
$routes->setDefaultController('Atendimento');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Atendimento::index');
$routes->get('pacientes', 'Api::all');
$routes->get('pacientes-incompletos', 'Api::incompletos');
$routes->get('panoramas/(:num)', 'Api::panoramas/$1');
$routes->get('anos', 'Api::anosListagem');
$routes->get('meses/(:num)', 'Api::mesesListagem/$1');
$routes->get('total/(:num)/(:num)', 'Api::detalhesMes/$1/$2');
$routes->get('abertos/(:num)/(:num)', 'Api::emAbertoMes/$1/$2');
$routes->get('concluidos/(:num)/(:num)', 'Api::concluidosMes/$1/$2');
$routes->get('cadastros/(:num)/(:num)', 'Api::cadastrosMes/$1/$2');
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
