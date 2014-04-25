<?php namespace Adstream\Controllers\Admin;

use View;
use Input;
use Redirect;
use Alert;
use Adstream\Models\Jobs;
use Adstream\Controllers\BaseController;

class JobsController extends BaseController {

    private $model;

    private $tableFields = array(
        'Name',
        'Enabled',
        'Created On'
    );

    // this is only necessary if we are using repository pattern
    public function __construct(Jobs $jobs)
    {
        parent::__construct();
        $this->model = $jobs;
    }

    public function index()
    {
        $jobs = $this->model->all();
        $fields = $this->tableFields;
        return View::make('admin.jobs.index', compact('jobs', 'fields'));
    }

    public function create()
    {
        return View::make('admin.jobs.create');
    }

    public function edit($id)
    {
        $job = $this->model->find($id);
        return View::make('admin.jobs.edit', compact('job'));
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