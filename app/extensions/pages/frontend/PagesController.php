<?php namespace Adstream\Controllers\Frontend;

use Adstream\Controllers\BaseController;

class PagesController extends BaseController {

  protected $pages;

  public function __construct(Pages $pages)
  {
    $this->pages = $pages;
  }

  public function page($pageSlug)
  {
    $community = $this->pages->where('slug', $pageSlug)->first();
	  $pieces = explode('/', $pageSlug);
	  $parentId = 0;

  	foreach ($pieces as $piece){
  		$page = $this->pages->select('id')->where('slug', $piece)->where('parent_id', $parentId)->firstOrFail();
  		$parentId = $page->id;
  	}

	  $page = $this->pages->where('id', $parentId)->firstOrFail();

    return View::make('frontend.communities.page', compact('community', 'page'));
  }

}