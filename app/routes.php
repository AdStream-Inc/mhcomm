<?php

$adminNs = 'Adstream\\Controllers\\Admin\\';

Route::get('installer', $adminNs . 'InstallerController@setup');
Route::post('installer', $adminNs . 'InstallerController@install');
Route::get('installer-finish', $adminNs . 'InstallerController@setupConfig');
Route::post('installer-finish', $adminNs . 'InstallerController@setConfig');
Route::post('wysiwyg-upload', 'Adstream\Controllers\WysiwygController@postIndex');

Route::group(array('before' => 'install'), function() use($adminNs) {
  Route::controller(Config::get('site.admin_url') . '/auth', $adminNs . 'AuthController');
  Route::group(
    array(
      'prefix' => Config::get('site.admin_url'),
      'namespace' => $adminNs,
      'before' => 'auth'
    ),
    function() {
      Route::get('users/list', 'UsersController@listData');
      Route::resource('users', 'UsersController');

      Route::get('jobs/list', 'JobsController@listData');
      Route::resource('jobs', 'JobsController');

      Route::get('specials/list', 'SpecialsController@listData');
      Route::resource('specials', 'SpecialsController');

      Route::get('communities/list', 'CommunitiesController@listData');
      Route::resource('communities', 'CommunitiesController');

      Route::resource('pages', 'PagesController');
      Route::resource('settings', 'SettingsController');

      // temp dashboard route
      Route::get('/', 'DashboardController@getIndex');
    });

  Route::get('/', function()
  {
  	return 'frontend';
  });

});