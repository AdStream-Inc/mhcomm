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
      'id' => 'created_on',
      'header' => array(
          array('text' => 'Created On'),
      ),
      'sort' => 'string',
      'adjust' => true,
    ),
  );

  public function __construct(Revisions $revisions)
  {
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
    $model = $this->findModel($revisions[0]);

    return View::make('admin.revisions.edit', compact('model', 'revisions'));
  }

  public function update($groupHash)
  {
    $approve = Input::get('approve');
    $deny = Input::get('deny');

    if (count($approve)) {
      foreach ($approve as $revisionId) {
        $revision = $this->revisions->find($revisionId);
        $model = $this->findModel($revision);
        $key = $revision->key;
        $value = $revision->new_value;

        $model->$key = $value;
        $revision->approved = 1;

        $model->save();
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

    $revisions = $this->revisions
      ->where('revisionable_type', 'Adstream\Models\Communities')
      ->where('approved', false)
      ->whereIn('user_id', $this->managers)
      ->get();

    $revisions = $this->presentListData($revisions);

    return Response::json(array('data' => $revisions, 'columns' => $this->tableFields));
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

    return Response::json(array('data' => $revisions, 'columns' => $this->tableFields));
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
      $model = $this->findModel($revision);
      $newRevisions[] = array(
        'name' => '<a href="' . url($this->adminUrl . '/revisions/' . $hash . '/edit') . '">' . $model->name . '</a>',
        'count' => $count,
        'user' => $revision->user->present()->fullName,
        'created_on' => $revision->present()->createdOn
      );
    }

    return $newRevisions;
  }

  private function findModel($revision)
  {
    $modelType = $revision->revisionable_type;
    $modelId = $revision->revisionable_id;
    $model = $modelType::find($modelId);

    return $model;
  }
}