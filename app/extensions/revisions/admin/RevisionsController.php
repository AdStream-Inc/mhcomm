<?php namespace Adstream\Controllers\Admin;

use View;
use Alert;
use Response;
use Str;
use Sentry;
use Input;
use Session;
use Redirect;
use Adstream\Models\Revisions;
use Adstream\Controllers\BaseController;

class RevisionsController extends BaseController {

  private $revisions;

  private $managers;

  private $tableFields = array(
    array(
      'id' => 'name',
      'header' => array(
          array('text' => 'Name'),
          array('content' => 'textFilter')
      ),
      'sort' => 'string',
      'fillspace' => true,
    ),
    array(
      'id' => 'user',
      'header' => array(
          array('text' => 'User'),
          array('content' => 'textFilter')
      ),
      'sort' => 'string',
      'fillspace' => true,
    ),
    array(
      'id' => 'count',
      'header' => array(
          array('text' => 'Revisions'),
      ),
      'sort' => 'integer',
    ),
    array(
      'id' => 'action',
      'header' => array(
          array('text' => 'Action'),
      ),
      'sort' => 'string',
    ),
	array(
		  'id' => 'parent',
		  'header' => array(
			  array('text' => 'Parent'),
		  ),
		  'sort' => 'string',
		  'adjust' => true,
	  ),
    array(
      'id' => 'created_on',
      'header' => array(
          array('text' => 'Created On'),
      ),
      'sort' => 'string',
      'adjust' => true,
    ),
  );

  public function __construct(Revisions $revisions){
	  
    parent::__construct();

    $this->revisions = $revisions;
    $managerGroup = Sentry::findGroupByName('Manager');
    $this->managers = Sentry::findAllUsersInGroup($managerGroup)->lists('id');
  }

  public function index()
  {
    return View::make('admin.revisions.index');
  }

  public function edit($groupHash)
  {
    $revisions = $this->revisions->where('group_hash', $groupHash)->get();
    $model = $this->findModel($revisions);

    return View::make('admin.revisions.edit.' . $revisions[0]->action, compact('model', 'revisions'));
  }

  public function update($groupHash)
  {
    $approve = Input::get('approve');
    $deny = Input::get('deny');

	//if we have approved updates in this revision
    if (count($approve)) {
		
	  $revisions = array();
	  
	  //loop through all the approves and store them in an array
      foreach ($approve as $revisionId) {
		  
        $revisions[] = $this->revisions->find($revisionId);
		
	  }
	  
	  $model = $this->findModel($revisions);
	  
	  foreach ($revisions as $revision){
		  
		  $model->{$revision->key} = $revision->new_value;
		  
	  }
	  
	  if ($revisions[0]->action == 'deleting') $model->delete();
	  else $model->save();
	  
	  foreach ($revisions as $revision){
	  
	    $revision->approved = 1;
        $revision->save();
		
	  }
		
    }

    if (count($deny)) {
      foreach ($deny as $revisionId) {
        $revision = $this->revisions->find($revisionId)->delete();
      }
    }

    return Redirect::to($this->adminUrl . '/' . Session::get('revision_page') . '/revisions');
  }

  public function listCommunitiesData()
  {
    Session::forget('revision_page');
    Session::put('revision_page', 'communities');

    $communityRevisions = $this->revisions
      ->where('revisionable_type', 'Adstream\Models\Communities')
      ->where('approved', false)
      ->whereIn('user_id', $this->managers)
      ->get();
	
	$revisions = $this->presentListData($communityRevisions);
	

    return Response::json(array('data' => $revisions, 'columns' => $this->getTableFields($revisions)));
  }
  
  public function listCommunityImagesData()
  {
    Session::forget('revision_page');
    Session::put('revision_page', 'communities/images');

    $revisions = $this->revisions
      ->where('revisionable_type', 'Adstream\Models\CommunityImages')
      ->where('approved', false)
      ->whereIn('user_id', $this->managers)
      ->get();
	
    $revisions = $this->presentListData($revisions);

    return Response::json(array('data' => $revisions, 'columns' => $this->getTableFields($revisions)));
  }

  public function listSpecialsData()
  {
    Session::forget('revision_page');
    Session::put('revision_page', 'specials');

    $revisions = $this->revisions
      ->where('revisionable_type', 'Adstream\Models\Specials')
      ->where('approved', false)
      ->whereIn('user_id', $this->managers)
      ->get();

    $revisions = $this->presentListData($revisions);

    return Response::json(array('data' => $revisions, 'columns' => $this->getTableFields($revisions)));
  }
  
  public function getTableFields($revisions = null){
	  
	  $fields = $this->tableFields;
	  
	  return $fields;
	  
  }

  private function presentListData($revisions)
  {
    $groupedRevisions = array();
    foreach ($revisions as $revision) {
      $groupedRevisions[$revision->group_hash][] = $revision;
    }

    $newRevisions = array();
    foreach ($groupedRevisions as $hash => $hashgroup) {
      $count = count($hashgroup);
      // technically we only need the first revision
      // to pull the data we need
      $revision = $hashgroup[0];
      $model = $this->findModel($hashgroup);
	  
      $array = array(
        'name' => '<a href="' . url($this->adminUrl . '/revisions/' . $hash . '/edit') . '">' . (!empty($model->name) ? $model->name : 'No Name Defined') . '</a>',
        'count' => $count,
        'user' => $revision->user->present()->fullName,
        'created_on' => $revision->present()->createdOn,
		'action' => $revision->action
      );
	  
	  if (!empty($revision->parent_type) && !empty($revision->parent_id)){
		  
		  $parent = $revision->parent_type;
		  $array['parent'] = $parent::find($revision->parent_id)->name;
	  
	  }
	  
	  $newRevisions[] = $array;
    }

    return $newRevisions;
  }

  private function findModel($hashgroup){
	  
	$revision = $hashgroup[0];
	
    $modelType = $revision->revisionable_type;
    $modelId = $revision->revisionable_id;
	
	//in the case of a 'creating' revision, we don't have a pre-existing row in the database, so we can't load the
	//model. since it's an insert, we have all the data we need in the revision table. all we need to do is create
	//a new instance of the model and add all the data from the revision to it.
	if ($revision->action == 'creating'){
		
		return new $modelType;
		
	}
	
	else return $modelType::find($modelId);
	
  }
}