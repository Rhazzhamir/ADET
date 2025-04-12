<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
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
$routes->get('/', 'Dashboard::index');
$routes->get('dashboard', 'Dashboard::index');
$routes->get('home', 'Home::index');

// Residents Routes
$routes->get('residents', 'Residents::index');
$routes->get('residents/add', 'Residents::add');
$routes->post('residents/save', 'Residents::save');
$routes->get('residents/households', 'Residents::households');
$routes->post('residents/saveHousehold', 'Residents::saveHousehold');

// Budget Routes
$routes->get('budget', 'Budget::index');
$routes->get('budget/expenses', 'Budget::expenses');
$routes->get('budget/reports', 'Budget::reports');

// Officials Routes
$routes->get('officials', 'Officials::index');
$routes->get('officials/add', 'Officials::add');
$routes->post('officials/save', 'Officials::save');
$routes->get('officials/positions', 'Officials::positions');

// Legal Routes
$routes->get('legal/privacy', 'Legal::privacy');
$routes->get('legal/terms', 'Legal::terms');

// Settings Routes
$routes->get('settings', 'Settings::index');

// Authentication Routes
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/login', 'Auth::login');
$routes->get('auth/register', 'Auth::register');
$routes->post('auth/register', 'Auth::register');
$routes->get('auth/logout', 'Auth::logout');
$routes->get('auth/admin_login', 'Auth::admin_login');
$routes->post('auth/admin_login', 'Auth::admin_login');

// Dashboard Routes
$routes->get('dashboard/resident', 'Dashboard::resident');

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
