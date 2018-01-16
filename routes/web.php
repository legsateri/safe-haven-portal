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


Route::get('/', 'PublicPagesController@index');

/**
 * admin panel routes
 */
Route::group(['prefix' => env('ADMIN_PANEL_LOCATION', 'admin')], function () {
	Route::get('/', 'AdminAuth\LoginController@showLoginForm')->name('admin.login');
	Route::post('/', 'AdminAuth\LoginController@login')->name('admin.login.submit');
	Route::post('/logout', 'AdminAuth\LoginController@logout')->name('admin.logout');

	// admin user registration routes
	// Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
	// Route::post('/register', 'AdminAuth\RegisterController@register');

	Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
	Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
	Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
	Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');

	// admin panel dashboard page
	Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');

	// user pages
	Route::get('/users', 'Admin\UsersController@index')->name('admin.users.list');
	Route::get('/users/add', 'Admin\UsersController@add')->name('admin.users.add');

	// client pages
	Route::get('/clients/clients', 'Admin\ClientsController@index')->name('admin.clients.list');
	Route::get('/clients/applications', 'Admin\ClientsController@add')->name('admin.clients.add');
	
	// pet pages
	Route::get('/clients/pets', 'Admin\PetsController@index')->name('admin.pets.list');
	
	// client applications pages
	Route::get('/clients/applications', 'Admin\ApplicationsController@index')->name('admin.applications.list');
	
	// settings pages
	Route::get('/settings/application', 'Admin\ApplicationSettingsController@index')->name('admin.settings.application');
	Route::get('/settings/admin-users', 'Admin\AdminUsersController@index')->name('admin.settings.admin-users');
	Route::get('/settings/account', 'Admin\AccountSettingsController@index')->name('admin.settings.account');

});


// Route::group(['middleware' => 'web'], function () {

	Auth::routes();

	// Route::get('/home', 'HomeController@index')->name('home');

	/**
	 *  user dashboard page
	 */
	Route::get('/dashboard', 'HomeController@index')->name('user.dashboard');

// });