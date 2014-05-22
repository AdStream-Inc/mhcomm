<?php namespace Adstream\Controllers\Admin;

use View;
use Input;
use Redirect;
use Alert;
use Request;
use Response;
use Sentry;
use DB;
use Adstream\Models\Specials;
use Adstream\Models\Communities;
use Adstream\Controllers\BaseController;

class SpecialsController extends BaseController {

  private $model;

  private $communities;

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
      'id' => 'is_enabled',
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

  public function __construct(Specials $specials, Communities $communities)
  {
    parent::__construct();

    $this->model = $specials;
    $this->communities = $communities;
  }

  public function index()
  {
    $specials = $this->model->count();

    return View::make('admin.specials.index', compact('specials'));
  }

  public function listData()
  {
    $columns = $this->tableFields;
    $user = Sentry::getUser();
    $manager = Sentry::findGroupByName('Manager');
	$superManager = Sentry::findGroupByName('Super Manager');

    if ($user->inGroup($manager) || $user->inGroup($superManager)) {
      $communities = $user->communities->lists('id');
      $pivotIds = DB::table('communities_specials')->whereIn('communities_id', $communities)->lists('specials_id');
      $specials = $this->model->whereIn('id', $pivotIds)->get();
    } else {
      $specials = $this->model->all();
    }

    foreach ($specials as &$special) {
      $special->name = '<a href="' . route($this->adminUrl . '.specials.edit', $special->id) . '">' . $special->name . '</a>';
      $special->created_on = $special->present()->createdOn;
      $special->is_enabled = $special->present()->isEnabled;
    }

    return Response::json(array('data' => $specials->toArray(), 'columns' => $columns));
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
	
	$result = $special->update(Input::all());
	
    if ($result || $special->revisionPending) {
		
      $special->communities()->sync(Input::get('communities'));
	  
	  $message = $result ? 'Special successfully updated!' : 'Your changes are pending approval from an administrator.';
	  
      Alert::success($message)->flash();
      return Redirect::route($this->adminUrl . '.specials.index');
	  
    }

    return Redirect::back()->withInput()->withErrors($special->getErrors());
  }

  public function destroy($id)
  {
    $special = $this->model->find($id);
    $special->delete();

    Alert::success('Special successfully deleted!')->flash();
    return Redirect::route($this->adminUrl . '.specials.index');
  }
}