<?php namespace Adstream\Controllers\Admin;

use Config;
use View;
use Input;
use Redirect;
use Sentry;
use Validator;
use Adstream\Controllers\BaseController;

class InstallerController extends BaseController {

  public function setup()
  {
    if (Config::get('site.installed')) return Redirect::intended();
    return View::make('installer.index');
  }

  public function install()
  {

    $rules = array(
        'admin_url' => 'required',
        'first_name' => 'required',
        'last_name' => 'required',
        'title' => 'required',
        'email' => 'required|email',
        'password' => 'required'
    );

    $validator = Validator::make(Input::all(), $rules);

    if ($validator->fails())
    {
        return Redirect::to('installer')->withErrors($validator)->withInput();
    }

    $adminGroup = Sentry::createGroup(Config::get('groups.admin'));

    $superUserGroup = Sentry::createGroup(Config::get('groups.superuser'));

    $superManagerGroup = Sentry::createGroup(Config::get('groups.supermanager'));

    $managerGroup = Sentry::createGroup(Config::get('groups.manager'));
	
    $user = Sentry::createUser(array(
        'email'     => Input::get('email'),
        'password'  => Input::get('password'),
        'first_name' => Input::get('first_name'),
        'last_name' => Input::get('last_name'),
        'activated' => true,
    ))->addGroup($adminGroup);

    Config::getLoader()->set('site.title', Input::get('title'));
    Config::getLoader()->set('site.admin_url', Input::get('admin_url'));
    Config::getLoader()->set('site.installed', 1);

    return Redirect::to(Input::get('admin_url'));
  }

}