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

	//============== Project Processing
	Route::resource('projectprocess', 'projectProcessController');
	Route::post('projectprocess/ajaxinvoice', 'projectProcessController@ajaxinvoice')->name('projectprocess.ajaxinvoice');
	Route::post('projectprocess/ajaxstoretp', 'projectProcessController@ajaxstoretp')->name('projectprocess.ajaxstoretp');
	Route::post('projectprocess/ajaxupdatetp', 'projectProcessController@ajaxupdatetp')->name('projectprocess.ajaxupdatetp');
	Route::post('projectprocess/ajaxtp', 'projectProcessController@ajaxtp')->name('projectprocess.ajaxtp');
	Route::post('projectprocess/ajaxfindtp', 'projectProcessController@ajaxfindtp')->name('projectprocess.ajaxfindtp');
	Route::resource('checklist', 'ChecklistController');
	Route::resource('process', 'ProcessController');
	
	//============== Alert Management
	Route::resource('alertmanagement', 'AlertManagementController');

	Route::resource('appointments', 'appointmentsController');
	// Manage Work Income
	//============== Appointments
	Route::resource('appointments', 'appointmentsController');
	//============== Quotations
	Route::resource('quotations', 'quotationsController');
	//============== Quotations Services
	Route::resource('quotationservices', 'quotationServicesController');
	Route::resource('quotations', 'quotationsController');
	//============== Invoices
	Route::resource('invoices', 'invoicesController');
	Route::get('invoices/{id}/detail', 'invoicesController@detail')->name('invoices.detail');
	//============== Invoices Detail
	Route::resource('invoicedetail', 'invoiceDetailController');
	//============== Recipts
	Route::resource('receipts', 'receiptsController');
	
	// Manage Expense
	//============== billsreceived
	Route::resource('billsreceived', 'billsreceivedController');
	//============== Accountpayable
	Route::resource('accountpayables', 'accountpayablesController');

	// Manage Report
	//============== ARReport
	Route::get('ARReport', 'ARReportController@index')->name('ARReport.index');
	Route::post('ARReport/search', 'ARReportController@search')->name('ARReport.search');
	Route::post('ARReport/receipts', 'ARReportController@receipts')->name('ARReport.receipts');
	// Route::post('ARReport/receipts', 'ARReportController@receipts')->name('ARReport.receipts');
	//============== APReport
	Route::get('APReport', 'APReportController@index')->name('APReport.index');
	Route::post('APReport/search', 'APReportController@search')->name('APReport.search');
	Route::post('APReport/payments', 'APReportController@payments')->name('APReport.payments');
	// Route::post('incomereport/receipts', 'IncomeReportController@receipts')->name('incomereport.receipts');
	//============== income report
	Route::get('incomereport', 'IncomeReportController@index')->name('incomereport.index');
	Route::post('incomereport/invoices', 'IncomeReportController@invoices')->name('incomereport.invoices');
	Route::post('incomereport/receipts', 'IncomeReportController@receipts')->name('incomereport.receipts');
	Route::post('incomereport/search', 'IncomeReportController@search')->name('incomereport.search');
	//============== expense report
	Route::get('expensereport', 'ExpenseReportController@index')->name('expensereport.index');
	Route::post('expensereport/bills', 'ExpenseReportController@bills')->name('expensereport.bills');
	Route::post('expensereport/payments', 'ExpenseReportController@payments')->name('expensereport.payments');
	Route::post('expensereport/search', 'ExpenseReportController@search')->name('expensereport.search');
	//============== ProfitLoss report
	Route::get('profitloss', 'ProfitLossController@index')->name('profitloss.index');
	Route::post('profitloss/receipts', 'ProfitLossController@receipts')->name('profitloss.receipts');
	Route::post('profitloss/search', 'ProfitLossController@search')->name('profitloss.search');


	// Manage services
	//============== Main Services
	Route::resource('mainservices', 'mainServicesController');
	//============== Services
	Route::resource('services', 'servicesController');

	// Manage Company
	//============== objectives
	Route::resource('objectives', 'objectivesController');
	//============== companies
	Route::get('companies/list', 'companiesController@list')->name('companies.list');
	Route::resource('companies', 'companiesController');
	Route::get('companies/{id}/image', 'companiesController@image')->name('companies.image');
	Route::put('companies/{id}/image_update', 'companiesController@image_update')->name('companies.image_update');
	//============== File Catetgories
	Route::resource('filecategories', 'fileCategoriesController');
	//============== Files
	Route::resource('files', 'filesController');
	Route::get('files/{id}/pdf', 'filesController@pdfViewer')->name('files.pdf');
	

	// Manage User
	//============== Staffs
	Route::resource('staffs', 'StaffsController');
	//============== User Role
	Route::resource('roles', 'userRolesController');
	//============== Users
	Route::resource('users', 'usersController');
	Route::get('users/{id}/password', 'usersController@password')->name('users.password');
	Route::put('users/{id}/password_update', 'usersController@password_update')->name('users.password_update');
	Route::put('users/{id}/status', 'usersController@status')->name('users.status');
	Route::get('users/{id}/image', 'usersController@image')->name('users.image');
	Route::put('users/{id}/image_update', 'usersController@image_update')->name('users.image_update');
	Route::get('users/{id}/role', 'usersController@role')->name('users.role');
	Route::put('users/{id}/role_update', 'usersController@role_update')->name('users.role_update');
	//============== Staffs
	Route::get('permissions', 'PermissionController@index')->name('permissions.index');
	Route::post('permissions/set_permission', 'PermissionController@set_permission')->name('permissions.set_permission');
	Route::post('permissions/update_permission', 'PermissionController@update_permission')->name('permissions.update_permission');

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
	Route::post('ajax/invoiceCompany', 'ajaxController@invoiceCompany')->name('ajax.invoiceCompany');
	Route::post('ajax/quotationservices', 'ajaxController@quotationservices')->name('ajax.quotationservices');
	Route::post('ajax/receiptinvoice', 'ajaxController@receiptinvoice')->name('ajax.receiptinvoice');
	Route::post('ajax/accountpayable', 'ajaxController@accountpayable')->name('ajax.accountpayable');

	
	//============== Error Controller
	Route::get('errors/permission', 'ErrorController@permission')->name('errors.permission');

});