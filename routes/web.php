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
	 * auth guard
	 * restricted for logged-in admin user
	 */
	Route::group(['middleware' => ['admin']], function () {

		// admin panel dashboard page
		Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');

		// user pages
		Route::get('/users/advocates', 'Admin\UsersController@advocates')->name('admin.users.advocates.list');
		Route::get('/users/shelters', 'Admin\UsersController@shelters')->name('admin.users.shelters.list');
		Route::get('/users/user-add', 'Admin\UsersController@add')->name('admin.users.user_add.list');
		Route::post('/users/user-add', 'Admin\UsersController@addSubmit')->name('admin.users.user_add.submit');

		// edit user page
		Route::get('/user/{id}/{slug}', 'Admin\UserEditController@editUserPage')->name('admin.user.edit.page');
		// edit user form submits
		Route::post('/user/{id}/{slug}/edit/general', 'Admin\UserEditController@submitGeneral')->name('admin.user.edit.submit.general');
		Route::post('/user/{id}/{slug}/edit/contact', 'Admin\UserEditController@submitContact')->name('admin.user.edit.submit.contact');
		Route::post('/user/{id}/{slug}/edit/password', 'Admin\UserEditController@submitPassword')->name('admin.user.edit.submit.password');
		Route::post('/user/{id}/{slug}/edit/verified', 'Admin\UserEditController@submitVerified')->name('admin.user.edit.submit.verified');
		Route::post('/user/{id}/{slug}/edit/ban', 'Admin\UserEditController@submitBan')->name('admin.user.edit.submit.ban');



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
		Route::get('/settings/admin-user/{id}', 'Admin\AdminUsersController@single')->name('admin.settings.admin-user.single');
		Route::get('/settings/account', 'Admin\AccountSettingsController@index')->name('admin.settings.account');

		// submit form for admin name and email update
        Route::post('/settings/account/update/info', 'Admin\AccountSettingsController@updateInfo')->name('admin.settings.account.update.info');
        Route::post('/settings/account/update/password', 'Admin\AccountSettingsController@updatePassword')->name('admin.settings.account.update.password');       
	});

});

	/**
	 * user auth routes
	 */
	Auth::routes();
	Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

	/**
	 * auth guard
	 * restricted for logged-in user
	 */
	Route::group(['middleware' => ['auth']], function () {

		/**
		 *  user dashboard page
		 */
		Route::get('/dashboard', 'HomeController@index')->name('user.dashboard');

		/**
		 *  advocate user routes
		 */

		// associated clients list page
		Route::get('/clients', 'Advocate\ClientsController@associatedList')->name('advocate.clients.associated.list');
		// clients in need list page
		Route::get('/clients/in-need', 'Advocate\ClientsController@inNeedList')->name('advocate.clients-in-need.list');

		// new client application page (form)
		Route::get('/application/new', 'Advocate\ApplicationsController@newApplication')->name('advocate.application.new.form');
		// submit new client application form
		Route::post('/application/new', 'Advocate\ApplicationsController@newApplicationSubmit')->name('advocate.application.new.form.submit');

		Route::post('/application/new/ajax', 'Advocate\ApplicationsController@ajaxHandler')->name('advocate.application.ajax.handler');

		// ajax for accepting new client
		Route::post('/clients/accept/ajax', 'Advocate\ClientsController@acceptClient');
		// ajax for release client
		Route::post('/client/release/ajax', 'Advocate\ClientsController@releaseClient');

		// ajax request for oppening modal for Q&A
		Route::post('/client/get_thread/ajax', 'Shared\QuestionMessages@clientsListGetModal');

		// ajax request sending answer to question
		Route::post('/client/send_answer/ajax', 'Shared\QuestionMessages@clientSendAnswer');

		/**
		 *  shelter user routes
		 */

		// associated pets list page
		Route::get('/pets', 'Shelter\PetsController@associatedList')->name('shelter.pets.associated.list');
		// pets in need list page
		Route::get('/pets/in-need', 'Shelter\PetsController@inNeedList')->name('shelter.pets-in-need.list');

		// ajax for accepting new pet
		Route::post('/pet/accept/ajax', 'Shelter\PetsController@acceptpet');

		// ajax for release pet
		Route::post('/pet/release/ajax', 'Shelter\PetsController@releasePet');

		// ajax request for oppening modal for Q&A
		Route::post('/pet/get_thread/ajax', 'Shared\QuestionMessages@petListGetModal');

		// ajax request when shelter ask question in Q&A modal
		Route::post('/pet/send_question/ajax', 'Shared\QuestionMessages@sendQuestion');
		
		



		/**
		 *  advocate and shelters shared routes
		 */

		// my organisation page

		// user account page
		Route::get('/account', 'Shared\AccountController@index')->name('user.account.page');

		//Update Account info
		Route::post('/account/update/info', 'Shared\AccountController@updateInfo')->name('user.account.update.info');

		//Update Account password
		Route::post('/account/update/password', 'Shared\AccountController@updatePassword')->name('user.account.update.password');

		// user Organization page
		Route::get('/organization', 'Shared\OrganizationController@index')->name('user.organisation.page');

		//Update Organization info
		Route::post('/organization/update/info', 'Shared\OrganizationController@updateInfo')->name('user.organisation.update.info');


		/**
		 *  filters and other
		 */

		// submit list filters
		Route::post('/list-filters/{uenc}', 'Shared\ListFiltersController@submit')->name('list-filters.submit');

	});