<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// REMINDER put this in a composers file
View::composer('*', function($view) {
  $view->with('adminUrl', Config::get('site.admin_url'));
  $view->with('siteTitle', Config::get('site.title'));
});

// REMINDER put this in a macros file
$errors = Session::get('errors', new Illuminate\Support\MessageBag);

Form::macro('bootwrapped', function($name, $label, $callback) use ($errors)
{
  return sprintf(
    '<div class="form-group %s">
      <label class="control-label">%s</label>
      %s
      %s
    </div>',
    $errors->has($name) ? 'has-error' : '',
    $label,
    $callback($name),
    $errors->first($name, '<span class="help-block">:message</span>')
  );
});

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
  Route::controller('jobs', 'JobCOntorller');
});