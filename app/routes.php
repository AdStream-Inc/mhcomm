<?php

$adminNs = 'Adstream\\Controllers\\Admin\\';

Route::get('installer', $adminNs . 'InstallerController@setup');
Route::post('installer', $adminNs . 'InstallerController@install');

Route::group(array('before' => 'install'), function() use($adminNs) {
  Route::controller(Config::get('site.admin_url') . '/auth', $adminNs . 'AuthController');
  Route::group(
    array(
      'prefix' => Config::get('site.admin_url'),
      'namespace' => $adminNs,
      'before' => 'auth'
    ),
    function() {
      Route::resource('settings', 'SettingsController');
      Route::resource('users', 'UsersController');
      Route::resource('jobs', 'JobsController');

      // temp dashboard route
      Route::get('/', function() {
        return View::make('admin.dashboard');
      });
    });

  // temp default frontend route
  Route::get('/', function()
  {
  	return View::make('hello');
  });
});