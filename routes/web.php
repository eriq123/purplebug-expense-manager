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

Auth::routes(['reset'=>false]);

Route::group(['middleware' => ['auth','web']], function () 
{

	// dashboard
	Route::name('main.')->group(function () {
		Route::get('/', 'MainController@index')->name('index');
		Route::post('/graph', 'MainController@graph')->name('graph');
	});

	// roles
	Route::name('roles.')->group(function () {
		Route::get('/Roles', 'RolesController@index')->name('index');
		Route::post('/Roles/action', 'RolesController@action')->name('action');
	});

	// users
	Route::name('users.')->group(function () {
		Route::get('/Users', 'UserController@index')->name('index');
		Route::post('/Users/action', 'UserController@action')->name('action');
		Route::post('/Users/CheckRole', 'UserController@CheckRole')->name('CheckRole');
	});

	// category
	Route::name('categories.')->group(function () {
		Route::get('/Categories', 'CategoriesController@index')->name('index');
		Route::post('/Categories/action', 'CategoriesController@action')->name('action');
	});

	// expenses
	Route::name('expenses.')->group(function () {
		Route::get('/Expenses', 'ExpensesController@index')->name('index');
		Route::post('/Expenses/action', 'ExpensesController@action')->name('action');
		Route::post('/Expenses/UpdateModal', 'ExpensesController@UpdateModal')->name('UpdateModal');
	});

});
