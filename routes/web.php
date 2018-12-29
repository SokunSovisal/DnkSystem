<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Auth Route
	Auth::routes();
	// Registration Routes...
	Route::get('register', 'Auth\RegisterController@redirectRegister')->name('register');
	Route::post('register', 'Auth\RegisterController@redirectRegister');

	// Password Reset Routes...
	Route::get('password/reset', 'Auth\RegisterController@redirectRegister')->name('password.request');
	Route::post('password/email', 'Auth\RegisterController@redirectRegister')->name('password.email');
	Route::get('password/reset/{token}', 'Auth\RegisterController@redirectRegister')->name('password.reset');
	Route::post('password/reset', 'Auth\RegisterController@redirectRegister');



Route::group(['prefix' => '/', 'middleware' => 'auth'], function () {

	// ============= Home
	Route::get('', 'HomeController@index')->name('home');
	Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

	// Manage Work Processing
	//============== Appointments
	Route::resource('appointments', 'appointmentsController');
	//============== Quotations
	Route::resource('quotations', 'quotationsController');
	//============== Quotations Services
	Route::resource('quotationservices', 'quotationServicesController');
	Route::resource('quotations', 'quotationsController');
	// //============== Invoices
	Route::resource('invoices', 'invoicesController');
	// //============== Recipts
	Route::resource('recipts', 'reciptsController');


	// Manage services
	//============== Main Services
	Route::resource('mainservices', 'mainServicesController');
	//============== Services
	Route::resource('services', 'servicesController');


	// Manage Company
	//============== objectives
	Route::resource('objectives', 'objectivesController');
	//============== companies
	Route::resource('companies', 'companiesController');
	Route::get('companies/{id}/image', 'companiesController@image')->name('companies.image');
	Route::put('companies/{id}/image_update', 'companiesController@image_update')->name('companies.image_update');
	//============== File Catetgories
	Route::resource('filecategories', 'fileCategoriesController');
	//============== Files
	Route::resource('files', 'filesController');
	Route::get('files/{id}/pdf', 'filesController@pdfViewer')->name('files.pdf');
	//============== Download File
	// Route::get('download/{path}', function($path){
	// 		// Check if file exists in app/storage/file folder
	// 		$path_url = (explode("&",$path));
	// 		$file_path = public_path() .'/files/'. $path_url[0] .'/'. $path_url[1] .'/'. $path_url[2];
	// 		if (file_exists($file_path))
	// 		{
	// 			// Send Download
	// 			return Response::download($file_path, $path_url[2], [
	// 				'Content-Length: '. filesize($file_path)
	// 			]);
	// 		}else{
	// 			// Error
	// 			exit('Requested file does not exist on our server!');
	// 		}
	// })
	// ->where('filename', '[A-Za-z0-9\-\_\.]+');

	// Manage Company
	//============== User Role
	// Route::resource('roles', 'userRolesController');
	Route::get('roles', 'userRolesController@index')->name('roles.index');
	Route::get('roles/{id}/edit', 'userRolesController@edit')->name('roles.edit');
	Route::put('roles/{id}/update', 'userRolesController@update')->name('roles.update');
	//============== companies
	Route::resource('users', 'usersController');
	Route::get('users/{id}/password', 'usersController@password')->name('users.password');
	Route::put('users/{id}/password_update', 'usersController@password_update')->name('users.password_update');
	Route::put('users/{id}/status', 'usersController@status')->name('users.status');
	Route::get('users/{id}/image', 'usersController@image')->name('users.image');
	Route::put('users/{id}/image_update', 'usersController@image_update')->name('users.image_update');

	// Manage Location
	//============== provinces
	Route::resource('provinces', 'provincesController');
	//============== districts
	Route::resource('districts', 'districtsController');

	//============== Live Select Ajax
	// Route::get('ajax', 'ajaxController@index');
	Route::post('ajax/lselect', 'ajaxController@lselect')->name('ajax.lselect');
	Route::post('ajax/servicePrice', 'ajaxController@servicePrice')->name('ajax.servicePrice');
	Route::post('ajax/quoteCompany', 'ajaxController@quoteCompany')->name('ajax.quoteCompany');
	Route::post('ajax/quoteUser', 'ajaxController@quoteUser')->name('ajax.quoteUser');
	Route::post('ajax/appointmentServices', 'ajaxController@appointmentServices')->name('ajax.appointmentServices');
});