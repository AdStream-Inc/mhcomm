<?php namespace Adstream\Controllers\Admin;

use Config;
use View;
use Input;
use Redirect;
use Hash;
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

    $adminGroup = Sentry::createGroup(array(
        'name'        => 'Admin',
        'permissions' => array(
            'admin' => 1,
            'settings' => 1,
            'users.create' => 1,
            'users.edit' => 1,
            'users.list' => 1,
            'users.delete' => 1,
            'communities.create' => 1,
            'communities.edit' => 1,
            'communities.list' => 1,
            'communities.delete' => 1,
            'pages.create' => 1,
            'pages.edit' => 1,
            'pages.list' => 1,
            'pages.delete' => 1,
            'jobs.create' => 1,
            'jobs.edit' => 1,
            'jobs.list' => 1,
            'jobs.delete' => 1,
        ),
    ));

    $superUserGroup = Sentry::createGroup(array(
        'name'        => 'Super User',
        'permissions' => array(
            'admin' => 1,
            'settings' => 0,
            'users.create' => 0,
            'users.edit' => 1,
            'users.list' => 1,
            'users.delete' => 0,
            'communities.create' => 0,
            'communities.edit' => 1,
            'communities.list' => 1,
            'communities.delete' => 0,
            'pages.create' => 1,
            'pages.edit' => 1,
            'pages.list' => 1,
            'pages.delete' => 1,
            'jobs.create' => 1,
            'jobs.edit' => 1,
            'jobs.list' => 1,
            'jobs.delete' => 1,
        ),
    ));

    $superManagerGroup = Sentry::createGroup(array(
        'name'        => 'Super Manager',
        'permissions' => array(
            'admin' => 1,
            'settings' => 0,
            'users.create' => 0,
            'users.edit' => 0,
            'users.list' => 0,
            'users.delete' => 0,
            'communities.create' => 0,
            'communities.edit' => 1,
            'communities.list' => 1,
            'communities.delete' => 0,
            'pages.create' => 0,
            'pages.edit' => 0,
            'pages.list' => 0,
            'pages.delete' => 0,
            'jobs.create' => 0,
            'jobs.edit' => 0,
            'jobs.list' => 0,
            'jobs.delete' => 0,
        ),
    ));

    $managerGroup = Sentry::createGroup(array(
        'name'        => 'Manager',
        'permissions' => array(
            'admin' => 1,
            'settings' => 0,
            'users.create' => 0,
            'users.edit' => 0,
            'users.list' => 0,
            'users.delete' => 0,
            'communities.create' => 0,
            'communities.edit' => 1,
            'communities.list' => 1,
            'communities.delete' => 0,
            'pages.create' => 0,
            'pages.edit' => 0,
            'pages.list' => 0,
            'pages.delete' => 0,
            'jobs.create' => 0,
            'jobs.edit' => 0,
            'jobs.list' => 0,
            'jobs.delete' => 0,
        ),
    ));

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

    return Redirect::to(Config::get('site.admin_url'));
  }

}