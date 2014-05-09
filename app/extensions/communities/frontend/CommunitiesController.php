<?php namespace Adstream\Controllers\Frontend;

use View;
use Response;
use Str;
use Adstream\Models\Communities;
use Adstream\Controllers\BaseController;

class CommunitiesController extends BaseController {

  protected $communities;

  /**
     * The table fields for our data table
     * @var array
     */
  private $tableFields = array(
    array(
      'id' => 'name',
      'header' => array(
          array('text' => 'Name'),
          array('content' => 'textFilter')
      ),
      'fillspace' => true,
      'sort' => 'string'
    ),
    array(
      'id' => 'address',
      'header' => array(
          array('text' => 'Address'),
      ),
      'sort' => 'string',
      'fillspace' => true,
    ),
    array(
      'id' => 'city',
      'header' => 'City',
      'sort' => 'string'
    ),
    array(
      'id' => 'state',
      'header' => array(
          array('text' => 'State'),
          array('content' => 'selectFilter')
      ),
      'sort' => 'string',
    ),
    array(
      'id' => 'phone',
      'header' => 'Phone',
      'adjust' => true,
    ),
    array(
      'id' => 'view',
      'header' => '',
      'css' => 'text-align: center',
      'adjust' => true,
    ),
  );

  public function __construct(Communities $communities)
  {
    $this->communities = $communities;
  }


  public function index()
  {
    return View::make('frontend.communities.index');
  }

  public function getList()
  {
    $communities = $this->communities->all();
    foreach ($communities as $community) {
      $community->view = '<a href="' . url('communities/' . Str::slug($community->name)) . '.html">View</a>';
    }
    return Response::json(array('data' => $communities->toArray(), 'columns' => $this->tableFields));
  }

  public function show($slug)
  {
    $community = $this->communities->where('slug', $slug)->first();

    return View::make('frontend.communities.show', compact('community'));
  }
}