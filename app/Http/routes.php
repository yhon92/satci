<?php
Blade::setContentTags('<%', '%>'); // for variables and all things Blade
Blade::setEscapedContentTags('<%%', '%%>'); // for escaped data
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
	return view('layout');
});

/*Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);*/

Route::group(['prefix' => 'api', 'namespace' => 'Auth'], function ()
{
  Route::post('auth/login', 'AuthController@login');
  Route::get('auth/user', 'AuthController@getUser');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function ()
{
	Route::resource('users', 'UsersController');
});

Route::group(['prefix' => 'api', 'namespace' => 'Solicitude'], function ()
{
	Route::resource('solicitude', 'SolicitudeController');
	Route::get('solicitude/list/{applicant}', 'SolicitudeController@listByApplicant');
});

Route::group(['prefix' => 'api'], function ()
{
	Route::get('category/list', 'CategoryController@listCategoriesWithThemes');
	Route::resource('category', 'CategoryController');
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

Route::group(['prefix' => 'api'], function ()
{
	Route::resource('theme', 'ThemeController');
});
