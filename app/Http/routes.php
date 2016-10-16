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

Route::get('/', function () {
	return view('layouts.app');
});

Route::group(['prefix' => 'api', 'namespace' => 'Auth'], function () {
  
  Route::post('auth/login', 'AuthController@login');
  
  Route::get('auth/user', 'AuthController@user');

  Route::get('auth/permissions', 'AuthController@permissions');

});

Route::group(['prefix' => 'api', 'namespace' => 'Admin'], function () {

	Route::resource('user', 'UserController');

});

Route::group(['prefix' => 'api', 'namespace' => 'Solicitude'], function () {

  Route::get('solicitude/list/{applicant}', 'SolicitudeController@listByApplicant');

  Route::get('solicitude/assign/list/{solicitude}', 'AssignController@listBySolicitude');
	
  Route::put('solicitude/assign/observation/{id}', 'AssignController@updateObservation');

	Route::resource('solicitude/assign', 'AssignController');

	Route::resource('solicitude', 'SolicitudeController');
  
});

Route::group(['prefix' => 'api'], function () {
	
  Route::resource('area', 'AreaController');

  Route::get('category/list', 'CategoryController@listOnlyCategories');
  
  Route::resource('category', 'CategoryController');
  
  Route::resource('citizen', 'CitizenController');

  Route::resource('director', 'DirectorController');
  
  Route::resource('institution', 'InstitutionController');
  
  Route::resource('means', 'MeansController');

  Route::resource('parish', 'ParishController');
  
  Route::get('theme/list', 'ThemeController@getListThemesOrderByCategory');

  Route::resource('theme', 'ThemeController');

  Route::group(['prefix' => 'statistic'], function () {
    
    Route::get('/', 'StatisticController@index');
    
    Route::post('/allByStatus', 'StatisticController@allByStatus');
    
    Route::post('/allByApplicant', 'StatisticController@allByApplicant');

  });

  Route::group(['prefix' => 'report'], function () {
    
    // Route::get('/', 'ReportController@index');
    // Route::post('/', 'ReportController@index');
    // Route::post('/allByStatus', 'ReportController@allByStatus');
    
    Route::group(['prefix' => 'list'], function () {

      Route::post('/applicant', 'ReportController@listApplicant');

    });

  });
});

