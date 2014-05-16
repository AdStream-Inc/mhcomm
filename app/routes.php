<?php

$adminNs = 'Adstream\\Controllers\\Admin\\';
$frontendNs  = 'Adstream\\Controllers\\Frontend\\';

Route::get('installer', $adminNs . 'InstallerController@setup');
Route::post('installer', $adminNs . 'InstallerController@install');
Route::get('installer-finish', $adminNs . 'InstallerController@setupConfig');
Route::post('installer-finish', $adminNs . 'InstallerController@setConfig');
Route::post('wysiwyg-upload', 'Adstream\Controllers\WysiwygController@postIndex');

Route::group(array('before' => 'install'), function() use($adminNs, $frontendNs) {

  // Login
  Route::controller(Config::get('site.admin_url') . '/auth', $adminNs . 'AuthController');

  // Admin
  Route::group(
    array(
      'prefix' => Config::get('site.admin_url'),
      'namespace' => $adminNs,
      'before' => 'auth'
    ),
    function() {
      Route::get('revisions/{grouphash}/edit', 'RevisionsController@edit');
      Route::put('revisions/{grouphash}', 'RevisionsController@update');

      Route::get('users/list', 'UsersController@listData');
      Route::resource('users', 'UsersController');

      Route::get('jobs/list', 'JobsController@listData');
      Route::resource('jobs', 'JobsController');

      Route::get('specials/list', 'SpecialsController@listData');
      Route::get('specials/revisions', 'RevisionsController@index');
      Route::get('specials/revisions/list', 'RevisionsController@listSpecialsData');
      Route::resource('specials', 'SpecialsController');

      Route::get('communities/list', 'CommunitiesController@listData');
      Route::get('communities/revisions', 'RevisionsController@index');
      Route::get('communities/revisions/list', 'RevisionsController@listCommunitiesData');
      Route::resource('communities', 'CommunitiesController');

      Route::resource('pages', 'PagesController');

      Route::resource('community-pages', 'CommunityPagesController');

      Route::resource('settings', 'SettingsController');

      // temp dashboard route
      Route::get('/', 'DashboardController@getIndex');
    });

  Route::group(array('prefix' => 'communities', 'namespace' => $frontendNs), function() {

    Route::get('/', 'CommunitiesController@index');
    Route::get('/list', 'CommunitiesController@getList');

    Route::get('{community}.html', 'CommunitiesController@about');
    Route::get('{community}/specials.html', 'CommunitiesController@specials');
    Route::get('{community}/map.html', 'CommunitiesController@map');
    Route::get('{community}/contact.html', 'CommunitiesController@contact');

    Route::get('{community}/{slug?}.html', 'CommunitiesController@page')->where('slug', '.*');

  });

  Route::group(array('prefix' => 'jobs', 'namespace' => $frontendNs), function(){

	  Route::get('/', 'JobsController@index');
    Route::get('/{slug}.html', 'JobsController@show')->where('slug', '.*');

  });

  // Static pages
  Route::get('/', function(){
    return View::make('frontend.static.home');
  });

  Route::controller('contact', 'ContactController');

});