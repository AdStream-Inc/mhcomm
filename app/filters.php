<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('ssl', function(){

	if (!Request::secure() && App::environment('production')) return Redirect::secure(Request::getRequestUri());

});

Route::filter('auth', function()
{
	if (!Sentry::check()) return Redirect::guest(Config::get('site.admin_url') . '/auth/login');
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

Route::filter('install', function() {
  if (!Config::get('site.installed')) return Redirect::to('installer');
});

/**
 * Users url filer
 */
Route::filter('permissions.users', function() {
	$user = Sentry::getUser();
	if (!$user->hasAnyAccess(array('users.create', 'users.delete', 'users.list', 'users.edit'))) {
		return Redirect::to(Config::get('site.admin_url'));
	}
});

Route::when(Config::get('site.admin_url') . '/users*', 'permissions.users');

/**
 * Pages url filer
 */
Route::filter('permissions.pages', function() {
	$user = Sentry::getUser();
	if (!$user->hasAnyAccess(array('pages.create', 'pages.delete', 'pages.edit', 'pages.list'))) {
		return Redirect::to(Config::get('site.admin_url'));
	}
});

Route::when(Config::get('site.admin_url') . '/pages*', 'permissions.pages');

/**
 * Jobs url filer
 */
Route::filter('permissions.jobs', function() {
	$user = Sentry::getUser();
	if (!$user->hasAnyAccess(array('jobs.create', 'jobs.delete', 'jobs.edit', 'jobs.list'))) {
		return Redirect::to(Config::get('site.admin_url'));
	}
});

Route::when(Config::get('site.admin_url') . '/jobs*', 'permissions.jobs');

/**
 * Specials url filer
 */
Route::filter('permissions.specials', function() {
	$user = Sentry::getUser();
	if (!$user->hasAnyAccess(array('specials.edit', 'specials.list', 'specials.create', 'specials.delete'))) {
		return Redirect::to(Config::get('site.admin_url'));
	}
});

Route::when(Config::get('site.admin_url') . '/specials*', 'permissions.specials');

/**
 * Coupon url filer
 */
Route::filter('permissions.coupons', function() {
	$user = Sentry::getUser();
	if (!$user->hasAnyAccess(array('coupons'))) {
		return Redirect::to(Config::get('site.admin_url'));
	}
});

Route::when(Config::get('site.admin_url') . '/coupon', 'permissions.coupons');

/**
 * Reports url filer
 */
Route::filter('permissions.reports', function() {
	$user = Sentry::getUser();
	if (!$user->hasAnyAccess(array('reports'))) {
		return Redirect::to(Config::get('site.admin_url'));
	}
});

Route::when(Config::get('site.admin_url') . '/applications', 'permissions.reports');

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
