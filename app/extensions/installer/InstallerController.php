<?php namespace Adstream\Controllers\Admin;

use Config;
use View;
use Input;
use Redirect;
use Sentry;
use Validator;
use Artisan;

class InstallerController extends \Controller{

  public function setup()
  {
    if (Config::get('site.installed')) return Redirect::intended();
    return View::make('installer.index');
  }

  public function install()
  {

    $rules = array(
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email',
        'password' => 'required'
    );

    $validator = Validator::make(Input::all(), $rules);

    if ($validator->fails()) {
        return Redirect::to('installer')->withErrors($validator)->withInput();
    }

    try {
        Artisan::call('migrate', array('--package'=>'cartalyst/sentry'));
        Artisan::call('migrate', array('--package'=>'cartalyst/composite-config'));
        Artisan::call('migrate');
        Artisan::call('groups:update');
    } catch (Exception $e) {
        Response::make($e->getMessage(), 500);
    }

    $adminGroup = Sentry::findGroupByName('Admin');
    $adstreamGroup = Sentry::findGroupByName('Adstream');

    $user = Sentry::createUser(array(
        'email'     => Input::get('email'),
        'password'  => Input::get('password'),
        'first_name' => Input::get('first_name'),
        'last_name' => Input::get('last_name'),
        'activated' => true,
    ))->addGroup($adminGroup);

    $superuser = Sentry::createUser(array(
        'email'     => 'office@adstreaminc.com',
        'password'  => 'R29ray63!',
        'first_name' => 'Adstream',
        'last_name' => 'Inc',
        'activated' => true,
    ))->addGroup($adstreamGroup);

    return Redirect::to('installer-finish');
  }

  public function setupConfig()
  {
    return View::make('installer.config');
  }

  public function setConfig()
  {
    $rules = array(
        'admin_url' => 'required',
        'title' => 'required',
    );

    $validator = Validator::make(Input::all(), $rules);

    if ($validator->fails()) {
        return Redirect::to('installer-finish')->withErrors($validator)->withInput();
    }

    Config::getLoader()->set('site.title', Input::get('title'), '*');
    Config::getLoader()->set('site.admin_url', Input::get('admin_url'), '*');
    Config::getLoader()->set('site.installed', 1, '*');

    return Redirect::to(Input::get('admin_url'));
  }

}