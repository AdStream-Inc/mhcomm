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
        $settings = Input::all();

        if (isset($settings['admin_url']) && $settings['admin_url'] != Config::get('site.admin_url')) {
            foreach ($settings as $key => $setting) {
                Config::getLoader()->set('site.' . $key, $setting, '*');
            }

            // this will log us out and redirect us to new login page
            return Redirect::to($settings['admin_url'] . '/auth/logout');
        } else {
            foreach ($settings as $key => $setting) {
                Config::getLoader()->set('site.' . $key, $setting, '*');
            }

            Alert::success('Settings successfully updated!')->flash();
            return Redirect::route($this->adminUrl . '.settings.index');
        }
    }

}