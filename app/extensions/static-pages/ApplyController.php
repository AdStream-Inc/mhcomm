<?php

use Adstream\Controllers\BaseController;
use Adstream\Models\Communities;

class ApplyController extends BaseController {

  private $communities;

  public function __construct(Communities $communities)
  {
    $this->communities = $communities;
  }

  public function getIndex()
  {
    $communities = $this->communities->lists('name', 'name');
    return View::make('frontend.static.apply', compact('communities'));
  }

  public function postIndex()
  {
    $fields = array_except(Input::all(), array('_token'));

    Mail::send('emails.apply', $fields, function($message) use ($fields) {
      $message
        ->from('test@mhcomm.com', 'MHCOMM - Community Application Form')
        ->to('brandon@adstreaminc.com', 'david@adstreaminc.com')
        ->subject('Community Application Form Submission From ' . $fields['first_name'] . ' ' . $fields['last_name']);
    });

    return View::make('frontend.static.thanks');
  }
}

