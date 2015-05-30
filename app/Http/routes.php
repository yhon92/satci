<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function (){
	return redirect()->to('/home');
});

Route::get('/home', 'HomeController@index');

// Route::get('solicitude/', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);



Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function ()
{
	Route::resource('users', 'UsersController');
});

Route::group(['prefix' => 'api', 'namespace' => 'Solicitude'], function ()
{
	Route::resource('solicitude', 'SolicitudeController');
});

Route::group(['prefix' => 'api'], function ()
{
	Route::resource('citizen', 'CitizenController');
});

Route::group(['prefix' => 'api'], function ()
{
	Route::resource('institution', 'InstitutionController');
});

Route::group(['prefix' => 'api'], function ()
{
	Route::resource('parish', 'ParishController');
});