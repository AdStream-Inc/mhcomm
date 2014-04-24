<?php namespace Adstream\Controllers\Admin;

use View;
use Input;
use Redirect;
use Alert;
use Sentry;
use Adstream\Controllers\BaseController;

/** NOTE THIS IS CURRENTLY NOT IMPLEMENTED **/

class GroupsController extends BaseController {

    private $tableFields = array(
        'name' => 'Name',
        'slug' => 'Enabled',
        'created_at' => 'Created On'
    );

    public function index()
    {
        $groups = Sentry::findAllGroups();
        $fields = $this->tableFields;
        return View::make('admin.groups.index', compact('groups', 'fields'));
    }

    public function create()
    {
        return View::make('admin.groups.create');
    }

    public function edit($id)
    {
        $group = Sentry::findGroupById($id);
        $permissions = $group->getPermissions();

        return View::make('admin.groups.edit', compact('group'));
    }

    public function store()
    {
        $job = new $this->model(Input::all());

        if ($job->save()) {
            Alert::success('Job successfully added!')->flash();
            return Redirect::route($this->adminUrl . '.jobs.index');
        }

        return Redirect::back()->withInput()->withErrors($job->getErrors());
    }

    public function update($id)
    {
        $job = $this->model->find($id);

        if ($job->update(Input::all())) {
            Alert::success('Job successfully updated!')->flash();
            return Redirect::route($this->adminUrl . '.jobs.index');
        }

        return Redirect::back()->withInput()->withErrors($job->getErrors());
    }

}