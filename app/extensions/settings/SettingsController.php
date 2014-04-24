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

        Config::getLoader()->set('site.title', $title);
        Alert::success('Settings successfully updated!')->flash();

        return Redirect::route($this->adminUrl . '.settings.index');
    }

}