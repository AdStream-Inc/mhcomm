<?php namespace Adstream\Controllers\Frontend;

use App;
use View;
use Response;
use Str;
use Adstream\Models\Communities;
use Adstream\Models\CommunityPages;
use Adstream\Controllers\BaseController;

class CommunitiesController extends BaseController {

  protected $communities;
  protected $communityPages;

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

  public function __construct(Communities $communities, CommunityPages $communityPages)
  {
    $this->communities = $communities;
    $this->communityPages = $communityPages;
  }


  public function index()
  {
    $communities = $this->communities->all()->sortBy('name');
    return View::make('frontend.communities.index', compact('communities'));
  }

  public function getList()
  {
    $communities = $this->communities->all();
    foreach ($communities as $community) {
      $community->view = '<a href="' . url('communities/' . Str::slug($community->name)) . '.html">View</a>';
    }
    return Response::json(array('data' => $communities->toArray(), 'columns' => $this->tableFields));
  }

  public function show($slug, $content = 'about'){

	  $community = $this->communities->where('slug', $slug)->firstOrFail();

	  return View::make('frontend.communities.show', compact('community', 'content'));

  }

  public function about($slug){

	return $this->show($slug);

  }

  public function specials($slug){

	return $this->show($slug, 'specials');

  }

  public function map($slug){

	return $this->show($slug, 'map');

  }

  public function contact($slug){

	return $this->show($slug, 'contact');

  }

  public function page($communitySlug, $pageSlug)
  {

    $community = $this->communities->where('slug', $communitySlug)->first();

	$pieces = explode('/', $pageSlug);

	$parentId = 0;

	foreach ($pieces as $piece){

		$page = $this->communityPages->select('id')->where('slug', $piece)->where('parent_id', $parentId)->firstOrFail();

		$parentId = $page->id;

	}

	$page = $this->communityPages->where('id', $parentId)->firstOrFail();

    return View::make('frontend.communities.page', compact('community', 'page'));
  }

}