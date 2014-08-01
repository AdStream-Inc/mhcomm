<?php

$adminNs = 'Adstream\\Controllers\\Admin\\';
$frontendNs  = 'Adstream\\Controllers\\Frontend\\';
Route::get('installer', $adminNs . 'InstallerController@setup');
Route::post('installer', $adminNs . 'InstallerController@install');
Route::get('installer-finish', $adminNs . 'InstallerController@setupConfig');
Route::post('installer-finish', $adminNs . 'InstallerController@setConfig');
Route::post('wysiwyg-upload', 'Adstream\Controllers\WysiwygController@postIndex');

Route::group(array('before' => 'install'), function() use($adminNs, $frontendNs) {

  /**
   * Login
   */
  Route::controller('password', $adminNs . 'RemindersController');
  Route::controller(Config::get('site.admin_url') . '/auth', $adminNs . 'AuthController');

  /**
   * Admin routes with admin namespace
   */
  Route::group(
    array(
      'prefix' => Config::get('site.admin_url'),
      'namespace' => $adminNs,
      'before' => 'auth'
    ),
    function() {
      /**
       * Revision editing
       */
      Route::get('revisions/{grouphash}/edit', 'RevisionsController@edit');
      Route::put('revisions/{grouphash}', 'RevisionsController@update');

      /**
       * Users
       */
      Route::get('users/list', 'UsersController@listData');
      Route::resource('users', 'UsersController');

      /**
       * Jobs
       */
      Route::get('jobs/list', 'JobsController@listData');
      Route::resource('jobs', 'JobsController');

      /**
       * Specials
       */
      Route::get('specials/list', 'SpecialsController@listData');
      Route::get('specials/revisions', 'RevisionsController@index');
      Route::get('specials/revisions/list', 'RevisionsController@listSpecialsData');
      Route::resource('specials', 'SpecialsController');

      /**
       * Communities / community images / community revision
       */
      Route::get('communities/list', 'CommunitiesController@listData');
  	  Route::get('communities/revisions', 'RevisionsController@index');
  	  Route::get('communities/revisions/list', 'RevisionsController@listCommunitiesData');
      Route::get('communities/images/revisions', 'RevisionsController@index');
	    Route::get('communities/images/revisions/list', 'RevisionsController@listCommunityImagesData');
      Route::resource('communities', 'CommunitiesController');

      /**
       * Pages
       */
      Route::resource('pages', 'PagesController');

      /**
       * Community pages
       */
      Route::get('community-pages/revisions', 'RevisionsController@index');
      Route::get('community-pages/revisions/list', 'RevisionsController@listCommunitiesPagesData');
      Route::get('community-pages/{id}/copy', 'CommunityPagesController@copy');
      Route::resource('community-pages', 'CommunityPagesController');

      /**
       * Settings
       */
      Route::resource('settings', 'SettingsController');

      /**
       * Applicants
       */
      Route::resource('applications', 'ApplicationsController');

      /**
       * Coupon
       */
      Route::resource('coupon', 'CouponController');

      /**
       * Dashboard
       */
      Route::get('/', 'DashboardController@getIndex');
    });

  if (isset($_SERVER) && isset($_SERVER['HTTP_HOST'])) {
    $subdomain = explode('.', $_SERVER['HTTP_HOST']);
    if (count($subdomain) > 2) {
      $subdomain = $subdomain[0];
    } else {
      $subdomain = null;
    }

    if ($subdomain && in_array($subdomain, array('new', 'www'))) {
      Route::group(array('domain' => '{prefix}.mhcomm.com'), function() {
        Route::get('/', function($prefix) {
          $community = \Adstream\Models\Communities::where('subdomain', $prefix)->first();

          if ($community) {
            return Redirect::to('communities/' . $community->slug . '.html', 301);
          }
        });
      });
    }
  }

  Route::group(array('prefix' => 'communities', 'namespace' => $frontendNs), function() {

    Route::get('/', 'CommunitiesController@index');
    Route::get('{community}.html', 'CommunitiesController@about');
    Route::get('{community}/apply.html', 'CommunitiesController@apply');
    Route::post('{community}/apply.html', 'CommunitiesController@applySubmit');
    Route::get('{community}/specials.html', 'CommunitiesController@specials');
    Route::get('{community}/map.html', 'CommunitiesController@map');
    Route::get('{community}/contact.html', 'CommunitiesController@contact');
    Route::get('{community}/events.html', 'CommunitiesController@events');
    Route::get('{community}/newsletters.html', 'CommunitiesController@newsletters');
    Route::post('{community}/contact.html', 'CommunitiesController@contactSubmit');

    Route::get('{community}/{slug?}.html', 'CommunitiesController@page')->where('slug', '.*');

  });

  Route::group(array('prefix' => 'jobs', 'namespace' => $frontendNs), function(){

	  Route::get('/', 'JobsController@index');
    Route::get('/{slug}.html', 'JobsController@show')->where('slug', '.*');

  });

  Route::group(array('namespace' => $frontendNs), function(){
	   Route::get('{slug?}.html', 'PagesController@page')->where('slug', '.*');
  });

  Route::get('home-map', function() {
    return Response::json(\Adstream\Models\Communities::all()->toArray());
  });

	Route::controller('apply', 'ApplyController');
  Route::controller('contact', 'ContactController');

  // Static pages
  Route::get('/', function() {
    $specials = \Adstream\Models\Specials::where('on_homepage', true)->get();
    $featured = \Adstream\Models\Communities::where('is_featured', true)->orderBy(DB::raw('RAND()'))->take(2)->get();
    return View::make('frontend.static.home', compact('featured', 'specials'));
  });

});