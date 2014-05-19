<?php namespace Adstream\Controllers\Frontend;

use App;
use View;
use Response;
use Str;
use Input;
use Mail;
use Adstream\Models\Communities;
use Adstream\Models\CommunityPages;
use Adstream\Controllers\BaseController;

class CommunitiesController extends BaseController {

  protected $communities;
  protected $communityPages;

  public function __construct(Communities $communities, CommunityPages $communityPages)
  {
    $this->communities = $communities;
    $this->communityPages = $communityPages;
  }


  public function index()
  {
    if (Input::get('state_filter')) {
      $communities = $this->communities->where('state', Input::get('state_filter'))->get();
    } else {
      $communities = $this->communities->all()->sortBy('name');
    }
    $communityStates = $this->communities->lists('state', 'state');
    array_unshift($communityStates, '[ Filter by State ]');
    return View::make('frontend.communities.index', compact('communities', 'communityStates'));
  }

  public function apply($slug)
  {
    return $this->show($slug, 'apply');
  }

  public function show($slug, $content = 'about')
  {
	  $community = $this->communities->where('slug', $slug)->firstOrFail();
	  return View::make('frontend.communities.show', compact('community', 'content'));
  }

  public function about($slug)
  {
	  return $this->show($slug);
  }

  public function specials($slug)
  {
	  return $this->show($slug, 'specials');
  }

  public function map($slug)
  {
	  return $this->show($slug, 'map');
  }

  public function contact($slug)
  {
	  return $this->show($slug, 'contact');
  }

  public function contactSubmit()
  {
    $fields = array_except(Input::all(), array('_token'));

    Mail::send('emails.contact', $fields, function($message) use ($fields) {
      $sendTo = explode(',', $fields['send_to']);
      $message
        ->from('test@mhcomm.com', 'MHCOMM - Community Contact Form')
        ->to($sendTo)
        ->subject('Community Contact Form Submission From ' . $fields['first_name'] . ' ' . $fields['last_name']);
    });

    return View::make('frontend.static.thanks');
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