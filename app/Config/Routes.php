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
$routes->get('/', 'Home::index');
$routes->get('dashboard', 'Dashboard::index');
$routes->get('home', 'Home::index');

// Admin Routes
$routes->get('admin', 'ResidentController::index');
$routes->post('admin/save', 'ResidentController::save');
$routes->delete('admin/delete/(:num)', 'ResidentController::delete/$1');
$routes->get('admin/view/(:num)', 'ResidentController::view/$1');
$routes->post('admin/saveHousehold', 'Residents::saveHousehold');
$routes->get('admin/residents', 'ResidentController::index');
$routes->get('admin/residents/view/(:num)', 'ResidentController::viewPage/$1');

// Profile Picture Upload Route
$routes->post('residents/uploadProfilePicture', 'Residents::uploadProfilePicture');
$routes->get('test-profile-upload', 'Residents::testProfileUpload');

// Budget Routes
$routes->get('budget', 'Budget::index');
$routes->get('budget/expenses', 'Budget::expenses');
$routes->get('budget/budget', 'Budget::reports');

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

// Dashboard Routes
$routes->get('dashboard/resident', 'Dashboard::residentDashboard');
$routes->get('dashboard/profile', 'Dashboard::profile');
$routes->post('dashboard/change-password', 'Dashboard::changePassword');
$routes->post('dashboard/savePersonalInfo', 'Dashboard::savePersonalInfo');
$routes->post('dashboard/saveResidentRegistration', 'Dashboard::saveResidentRegistration');
$routes->post('dashboard/deleteMember/(:num)', 'Dashboard::deleteHouseholdMember/$1');

// Auth Routes
$routes->get('auth/resident/login', 'Auth::residentLogin');
$routes->get('auth/resident/register', 'Auth::residentRegister');
$routes->get('auth/admin_login', 'Auth::adminLogin');
$routes->post('auth/processResidentRegistration', 'Auth::processResidentRegistration');
$routes->post('auth/processResidentLogin', 'Auth::processResidentLogin');
$routes->post('auth/processAdminLogin', 'Auth::processAdminLogin');
$routes->get('auth/logout', 'Auth::logout');

// Resident Dashboard Routes
$routes->get('resident/dashboard', 'Dashboard::residentDashboard');

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
