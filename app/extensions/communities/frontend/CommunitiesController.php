<?php namespace Adstream\Controllers\Frontend;

use App;
use View;
use Response;
use Str;
use Input;
use Mail;
use Session;
use File;
use Adstream\Models\Communities;
use Adstream\Models\CommunityPages;
use Adstream\Controllers\BaseController;
use Adstream\Models\Coupon;

class CommunitiesController extends BaseController {

  protected $communities;
  protected $communityPages;
  protected $coupon;

  public function __construct(Communities $communities, CommunityPages $communityPages, Coupon $coupon)
  {
    parent::__construct();

    $this->communities = $communities;
    $this->communityPages = $communityPages;
    $this->coupon = $coupon;
  }


  public function index()
  {
    if (Input::get('state_filter')) {
      $communities = $this->communities->where('state', Input::get('state_filter'))->get();
    } else {
      $communities = $this->communities->all()->sortBy('name');
    }
    $communityStates = $this->communities->lists('state', 'state');
    array_unshift($communityStates, '-- Filter by State --');
    return View::make('frontend.communities.index', compact('communities', 'communityStates'));
  }

  public function apply($slug)
  {
    return $this->show($slug, 'apply');
  }

  public function applySubmit()
  {
    $fields = array_except(Input::all(), array('_token'));
    $community = Communities::where('name', $fields['community'])->first();
    $to = $community->users->lists('email');

    Mail::send('emails.apply', $fields, function($message) use ($fields, $to) {
      $message
        ->from('hello@mhcomm.com', 'MHCOMM - Community Application Form')
        ->to($to)
        ->subject('Community Application Form Submission From ' . $fields['first_name'] . ' ' . $fields['last_name']);
    });

    $content = $this->coupon->first()->content;
    $couponData = array(
      'phone' => $community->phone,
      'location' => $fields['community'],
      'content' => $content
    );

    Mail::send('emails.coupon', $couponData, function($message) use ($fields) {
      $message
        ->from('hello@mhcomm.com', 'MHCOMM - Application Coupon')
        ->to($fields['email'])
        ->subject('Community Application Coupon');
    });

    $applicantFields = array(
      'first_name' => $fields['first_name'],
      'last_name' => $fields['last_name'],
      'email' => $fields['email'],
      'phone' => $fields['phone'],
      'community' => $fields['community'],
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s')
    );

    $this->saveApplication($applicantFields);

    return View::make('frontend.static.apply-thanks', compact('couponData'));
  }

  public function show($slug, $content = 'about')
  {
	  $community = $this->communities->where('slug', $slug)->firstOrFail();
    Session::put('visited_community', $community->slug);

    $newsletters = $this->getNewsletters($community);

	  return View::make('frontend.communities.show', compact('community', 'content', 'newsletters'));
  }

  public function getNewsletters($community)
  {
    $newslettersDir = public_path() . '/uploads/' . $community->id . '/newsletters';
    $allFiles = File::files($newslettersDir);
    $newsletters = array();

    foreach ($allFiles as $file) {
        $fullPathName = public_path() . '/uploads/' . $community->id . '/newsletters/';
        $fileName = substr($file, strlen($fullPathName));
        $path = url('/') . '/uploads/' . $community->id . '/newsletters/' . $fileName;

        if ($path != $community->newsletter) {
            $newsletters[] = array(
                'original' => $file,
                'name' => $fileName,
                'path' => $path
            );
        }
    }

    return $newsletters;
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

  public function events($slug)
  {
    return $this->show($slug, 'events');
  }

  public function contact($slug)
  {
	  return $this->show($slug, 'contact');
  }

  public function newsletters($slug)
  {
    return $this->show($slug, 'newsletters');
  }

  public function contactSubmit()
  {
    $fields = array_except(Input::all(), array('_token'));
    $community = Communities::where('name', $fields['community'])->first();
    $to = array();

    if ($fields['type'] == 'Complaint') {
      $to = explode(',', $community->area_manager);
    } else {
      $managers = $community->users->lists('email');
      $areaManagers = explode(',', $community->area_manager);
      $to = array_merge($managers, $areaManagers);
    }

    Mail::send('emails.contact', $fields, function($message) use ($fields, $to) {
      $message
        ->from('hello@mhcomm.com', 'MHCOMM - Community Contact Form')
        ->to($to)
        ->subject('Community Contact Form Submission From ' . $fields['first_name'] . ' ' . $fields['last_name']);
    });

    return View::make('frontend.static.thanks');
  }

  public function page($communitySlug, $pageSlug)
  {
    $community = $this->communities->where('slug', $communitySlug)->first();
    $newsletters = $this->getNewsletters($community);
	  $pieces = explode('/', $pageSlug);
	  $parentId = 0;

  	foreach ($pieces as $piece){
  		$page = $this->communityPages->select('id')
        ->where('community_id', $community->id)
        ->where('slug', $piece)
        ->where('parent_id', $parentId)
        ->firstOrFail();

  		$parentId = $page->id;
  	}

	  $page = $this->communityPages->where('id', $parentId)->firstOrFail();

    return View::make('frontend.communities.page', compact('community', 'page', 'newsletters'));
  }

}