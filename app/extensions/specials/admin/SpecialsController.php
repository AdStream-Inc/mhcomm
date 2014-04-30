<?php namespace Adstream\Controllers\Admin;

use View;
use Input;
use Redirect;
use Alert;
use Adstream\Models\Specials;
use Adstream\Controllers\BaseController;

class SpecialsController extends BaseController {

  private $model;

  private $communities;

  public function __construct(Specials $specials)
  {
    parent::__construct();

    $this->model = $specials;
    // $this->communities = $communities;
  }

  public function index()
  {
    $specials = $this->model->all();
    return View::make('admin.specials.index', compact('specials'));
  }

  public function create()
  {
    $communities = array('0' => '[ Assign To All Communities ]');
    return View::make('admin.specials.create', compact('communities'));
  }

  public function store()
  {
    $special = new $this->model(Input::all());

    if ($special->save()) {
      Alert::success('Special successfully added!')->flash();
      return Redirect::route($this->adminUrl . '.specials.index');
    }

    return Redirect::back()->withInput()->withErrors($special->getErrors());
  }

  public function edit()
  {
    return View::make('admin.specials.edit');
  }

  public function update($id)
  {
    $special = $this->model->find($id);

    if ($special->update(Input::all())) {
      Alert::success('Special successfully updated!')->flash();
      return Redirect::route($this->adminUrl . '.jobs.index');
    }

    return Redirect::back()->withInput()->withErrors($special->getErrors());
  }

  public function delete($id)
  {

  }
}