<?php

use Adstream\Controllers\BaseController;
use Adstream\Models\Communities;

class ContactController extends BaseController {

  private $communities;

  public function __construct(Communities $communities)
  {
    $this->communities = $communities;
  }

  public function getIndex()
  {
    $communities = $this->communities->lists('name', 'name');
    return View::make('frontend.static.contact', compact('communities'));
  }

  public function postIndex()
  {
    $fields = array_except(Input::all(), array('_token'));

    Mail::send('emails.contact', $fields, function($message) use ($fields) {
      $message
        ->from('hello@mhcomm.com', 'MHCOMM - Contact Form')
        ->to(Config::get('site.generic_contact'))
        ->subject('Contact Form Submission From ' . $fields['first_name'] . ' ' . $fields['last_name']);
    });

    return View::make('frontend.static.thanks');
  }
}

