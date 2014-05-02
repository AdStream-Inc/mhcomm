<?php namespace Adstream\Controllers\Admin;

use View;
use Input;
use Redirect;
use Alert;
use Adstream\Models\Specials;
use Adstream\Models\Communities;
use Adstream\Controllers\BaseController;

class SpecialsController extends BaseController {

  private $model;

  private $communities;

  private $tableFields = array('Name', 'Enabled', 'Created On');

  public function __construct(Specials $specials, Communities $communities)
  {
    parent::__construct();

    $this->model = $specials;
    $this->communities = $communities;
  }

  public function index()
  {
    $specials = $this->model->all();
    $fields = $this->tableFields;
    return View::make('admin.specials.index', compact('specials', 'fields'));
  }

  public function create()
  {
    $communities = $this->communities->lists('name', 'id');

    return View::make('admin.specials.create', compact('communities'));
  }

  public function store()
  {
    $special = new $this->model(Input::all());

    if ($special->save()) {
      $special->communities()->sync(Input::get('communities'));
      Alert::success('Special successfully added!')->flash();
      return Redirect::route($this->adminUrl . '.specials.index');
    }

    return Redirect::back()->withInput()->withErrors($special->getErrors());
  }

  public function edit($id)
  {
    $communities = $this->communities->lists('name', 'id');
    $special = $this->model->find($id);
    $activeCommunities = $special->communities()->lists('id');
    return View::make('admin.specials.edit', compact('special', 'communities', 'activeCommunities'));
  }

  public function update($id)
  {
    $special = $this->model->find($id);

    if ($special->update(Input::all())) {
      $special->communities()->sync(Input::get('communities'));
      Alert::success('Special successfully updated!')->flash();
      return Redirect::route($this->adminUrl . '.specials.index');
    }

    return Redirect::back()->withInput()->withErrors($special->getErrors());
  }

  public function delete($id)
  {

  }
}