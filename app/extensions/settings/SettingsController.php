<?php namespace Adstream\Controllers\Admin;

use Config;
use View;
use Input;
use Redirect;
use Alert;
use Sentry;
use Adstream\Controllers\BaseController;

class SettingsController extends BaseController {

    public function index()
    {
        return View::make('admin.settings.index');
    }

    public function store()
    {
        $title = Input::get('title');
        $adminUrl = Input::get('admin_url');

        if ($adminUrl != Config::get('site.admin_url')) {
            Config::getLoader()->set('site.title', $title);
            Config::getLoader()->set('site.admin_url', $adminUrl);

            // we have to logout user so new admin URL can take affect
            Sentry::logout();
            return Redirect::to(Config::get('site.admin_url') . '/auth/login');
        } else {
            Config::getLoader()->set('site.title', $title);
            Alert::success('Settings successfully updated!')->flash();
            return Redirect::route($this->adminUrl . '.settings.index');
        }
    }

}