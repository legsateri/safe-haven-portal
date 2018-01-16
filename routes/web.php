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

	/**
	 * restricted for logged-in admin user
	 */

	Route::group(['middleware' => ['admin']], function () {

		// admin panel dashboard page
		Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');

		// user pages
		Route::get('/users/users-all', 'Admin\UsersController@index')->name('admin.users.users_all.list');
		Route::get('/users/advocates', 'Admin\UsersController@advocates')->name('admin.users.advocates.list');
		Route::get('/users/shelters', 'Admin\UsersController@shelters')->name('admin.users.shelters.list');
		Route::get('/users/user-add', 'Admin\UsersController@add')->name('admin.users.user_add.list');

		// client pages
		Route::get('/clients/clients-all', 'Admin\ClientsController@index')->name('admin.clients.clients_all.list');
		Route::get('/clients/client-add', 'Admin\ClientsController@add')->name('admin.clients.client_add.list');
		
		// pet pages
		Route::get('/clients/pets-all', 'Admin\PetsController@index')->name('admin.clients.pets_all.list');
		
		// client applications pages
		Route::get('/clients/applications', 'Admin\ApplicationsController@index')->name('admin.clients.applications.list');
		
		// settings pages
		Route::get('/settings/application', 'Admin\ApplicationSettingsController@index')->name('admin.settings.application');
		Route::get('/settings/admin-users', 'Admin\AdminUsersController@index')->name('admin.settings.admin-users');
		Route::get('/settings/account', 'Admin\AccountSettingsController@index')->name('admin.settings.account');

	});

});

	/**
	 * user auth routes
	 */
	Auth::routes();


	/**
	 *  user dashboard page
	 */
	Route::get('/dashboard', 'HomeController@index')->name('user.dashboard');
