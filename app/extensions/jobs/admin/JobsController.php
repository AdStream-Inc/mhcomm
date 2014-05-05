<?php namespace Adstream\Controllers\Admin;

use View;
use Input;
use Redirect;
use Alert;
use Response;
use Request;
use Adstream\Models\Jobs;
use Adstream\Controllers\BaseController;

class JobsController extends BaseController {

    private $model;

    private $tableFields = array(
        array(
            'id' => 'name',
            'header' => array(
                array('text' => 'Name'),
                array('content' => 'textFilter')
            ),
            'adjust' => true,
            'fillspace' => true,
            'sort' => 'string'
        ),
        array(
            'id' => 'enabled',
            'header' => array(
                array('text' => 'Available'),
                array('content' => 'selectFilter')
            ),
            'sort' => 'string'
        ),
        array(
            'id' => 'created_on',
            'header' => 'Created On',
            'adjust' => true,
            'sort' => 'string'
        )
    );

    /**
     * Setup Jobs repository and construct BaseController
     * for additional properties
     * @param Jobs $jobs Jobs repository
     */
    public function __construct(Jobs $jobs)
    {
        parent::__construct();
        $this->model = $jobs;
    }

    public function index()
    {
        $jobs = $this->model->all();
        $columns = $this->tableFields;

        foreach ($jobs as &$job) {
            $job->name = '<a href="' . route($this->adminUrl . '.jobs.edit', $job->id) . '">' . $job->name . '</a>';
            $job->enabled = $job->present()->available;
            $job->created_on = $job->present()->createdOn;
        }

        if (Request::ajax()) {
            return Response::json(array('data' => $jobs->toArray(), 'columns' => $columns));
        }

        return View::make('admin.jobs.index', compact('jobs'));
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