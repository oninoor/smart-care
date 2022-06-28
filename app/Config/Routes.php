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
$routes->setDefaultController('SetUp');
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

// -------------Routes Register-------------
$routes->get('/register', 'Auth::show_register');

$routes->post('/register', 'Auth::process_register');




// -------------Routes Dashboard-------------
$routes->get('/dashboard', 'Dashboard::index');




// -------------Routes Apps-------------
$routes->get('/apps/simrs-credential', 'Apps::show_simrs_credential');
$routes->get('/apps/my-credential', 'Apps::show_my_credential');




// -------------Routes Profile-------------
$routes->get('/profile/my-profile', 'Profile::index');
$routes->get('/profile/change-password', 'Profile::show_change_password');

$routes->post('profile/process-change-password', 'Profile::process_change_password');
$routes->post('profile/process-edit-user', 'Profile::process_edit_user');
$routes->post('profile/process-edit-photo', 'Profile::process_edit_photo');
$routes->post('/profile/process-edit-user', 'Profile::process_edit_user');




// -------------Routes Profile-------------
$routes->get('/admin/show-hospital', 'Admin::show_hospital');
$routes->get('/admin/edit-hospital/(:num)', 'Admin::show_edit_hospital/$1');

$routes->post('/admin/process-edit-hospital', 'Admin::process_edit_hospital');





// -------------Routes Setup-------------
$routes->get('/set-up', 'SetUp::index');
$routes->get('/set-up/credentials', 'SetUp::show_credentials');

$routes->post('/set-up', 'SetUp::process_set_up');
$routes->post('/set-up/get-hospital', 'SetUp::provide_hospitals');
$routes->post('/set-up/process-hospital-data', 'SetUp::process_hospital_data');
$routes->post('/set-up/process-credential', 'SetUp::process_credential');




// -------------Routes API - Disable Controller Direct Access-------------
$routes->get('/apihospital', 'Errors::forbidden');
$routes->get('/apihospital/(:any)', 'Errors::forbidden');
$routes->get('/apivisit', 'Errors::forbidden');
$routes->get('/apivisit/(:any)', 'Errors::forbidden');




// -------------Routes API-------------
$routes->get('/api/hospital', 'ApiHospitals::index');

$routes->post('/api/visit', 'ApiVisits::index');



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
