<?php namespace Adstream\Controllers\Admin;

use View;
use Input;
use Redirect;
use Alert;
use Adstream\Models\Communities;
use Adstream\Controllers\BaseController;

class CommunitiesController extends BaseController {

    private $model;

    /**
     * The table fields for our data table
     * @var array
     */
    private $tableFields = array(
        'Name',
        'Available',
        'Created On'
    );

    /**
     * Setup Communities repository and construct BaseController
     * for additional properties
     * @param Communities $communities Communities repository
     */
    public function __construct(Communities $communities)
	{
		
        parent::__construct();
        $this->model = $communities;
		
    }

    public function index(){
		
        $communities = $this->model->all();
        $fields = $this->tableFields;
        return View::make('admin.communities.index', compact('communities', 'fields'));
    }

    public function create()
    {
        return View::make('admin.communities.create');
    }

    public function edit($id)
    {
        $community = $this->model->find($id);
        return View::make('admin.communities.edit', compact('community'));
    }

    public function store()
    {
        $community = new $this->model(Input::all());

        if ($community->save()) {
            Alert::success('Community successfully added!')->flash();
            return Redirect::route($this->adminUrl . '.community.index');
        }

        return Redirect::back()->withInput()->withErrors($community->getErrors());
    }

    public function update($id)
    {
        $community = $this->model->find($id);

        if ($community->update(Input::all())) {
            Alert::success('Community successfully updated!')->flash();
            return Redirect::route($this->adminUrl . '.community.index');
        }

        return Redirect::back()->withInput()->withErrors($community->getErrors());
    }

}