<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('film_list');


Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'roles'], 'roles' => 'admin'], function () {
	Route::get('/', 'AdminController@index')->name('admin_panel');
	Route::resource('roles', 'RolesController');
	Route::resource('permissions', 'PermissionsController');
	Route::resource('users', 'UsersController');
	Route::resource('pages', 'PagesController');
	Route::resource('activitylogs', 'ActivityLogsController')->only([
		'index', 'show', 'destroy'
	]);
	Route::resource('settings', 'SettingsController');
	Route::get('generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
	Route::post('generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);

	Route::resource('films', 'FilmsController', ['names' => [
			'index' => 'admin_film_list'
	]]);
	Route::resource('actors', 'ActorsController');
});

Auth::routes();
