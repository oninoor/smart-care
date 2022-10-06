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
// $routes->get('/register', 'Auth::show_register');
// $routes->post('/register', 'Auth::process_register');



// -------------Routes Setup-------------
$routes->get('/set-up', 'SetUp::index');
$routes->get('/set-up/credentials', 'SetUp::show_credentials');

$routes->post('/set-up', 'SetUp::process_set_up');
$routes->post('/set-up/get-hospital', 'SetUp::provide_hospitals');
$routes->post('/set-up/process-hospital-data', 'SetUp::process_hospital_data');
$routes->post('/set-up/process-credential', 'SetUp::process_credential');




// -------------Routes Dashboard-------------
$routes->get('/', 'Dashboard::index');




// -------------Routes Apps-------------
$routes->get('/apps/hospital-credential', 'Apps::show_hospital_credential', ['filter' => 'role:user']);
$routes->get('/apps/smartcare-credential', 'Apps::show_smartcare_credential', ['filter' => 'role:user']);
$routes->get('/apps/api-request-sent', 'Apps::show_api_request_sent', ['filter' => 'role:user']);
$routes->get('/apps/api-request-accepted', 'Apps::show_api_request_accepted', ['filter' => 'role:user']);

$routes->post('/app/process-edit-hospital-credential', 'Apps::process_edit_hospital_credential', ['filter' => 'role:user']);




// -------------Routes Profile-------------
$routes->get('/profile', 'Profile::index', ['filter' => 'role:user']);
$routes->get('/profile/change-password', 'Profile::show_change_password', ['filter' => 'role:user']);

$routes->post('profile/process-change-password', 'Profile::process_change_password', ['filter' => 'role:user']);
$routes->post('/profile/process-edit-user', 'Profile::process_edit_user', ['filter' => 'role:user']);
$routes->post('/profile/process-edit-photo', 'Profile::process_edit_photo', ['filter' => 'role:user']);
$routes->post('/profile/process-edit-user', 'Profile::process_edit_user', ['filter' => 'role:user']);




// -------------Routes Admin-------------
$routes->get('/admin', 'Admin::index', ['filter' => 'role:admin']);
$routes->get('/admin/hospital', 'Admin::show_hospital', ['filter' => 'role:admin']);
$routes->get('/admin/add-hospital', 'Admin::show_add_hospital', ['filter' => 'role:admin']);
$routes->get('/admin/edit-hospital/(:num)', 'Admin::show_edit_hospital/$1', ['filter' => 'role:admin']);
$routes->get('/admin/users', 'Admin::show_users', ['filter' => 'role:admin']);
$routes->get('/admin/edit-user/(:num)', 'Admin::show_edit_user/$1', ['filter' => 'role:admin']);
$routes->get('/admin/add-user', 'Admin::show_add_user', ['filter' => 'role:admin']);

$routes->post('/admin/process-edit-hospital', 'Admin::process_edit_hospital', ['filter' => 'role:admin']);
$routes->post('/admin/process-add-hospital', 'Admin::process_add_hospital', ['filter' => 'role:admin']);
$routes->post('/admin/delete-hospital', 'Admin::delete_hospital', ['filter' => 'role:admin']);
$routes->post('/admin/process/add-user', 'Admin::process_add_user', ['filter' => 'role:admin']);
$routes->post('/admin/process-edit-user', 'Admin::process_edit_user', ['filter' => 'role:admin']);
$routes->post('/admin/process-edit-image-user', 'Admin::process_edit_image_user', ['filter' => 'role:admin']);
$routes->post('/admin/process-active', 'Admin::process_active', ['filter' => 'role:admin']);
$routes->post('/admin/process-role', 'Admin::process_role', ['filter' => 'role:admin']);



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
