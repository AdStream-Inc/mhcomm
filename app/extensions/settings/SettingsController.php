<?php namespace Adstream\Controllers\Admin;

use Config;
use View;
use Input;
use Redirect;
use Alert;
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

            // this will log us out and redirect us to new login page
            return Redirect::to($adminUrl . '/auth/logout');
        } else {
            Config::getLoader()->set('site.title', $title);
            Alert::success('Settings successfully updated!')->flash();
            return Redirect::route($this->adminUrl . '.settings.index');
        }
    }

}