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
        ->from('test@mhcomm.com', 'MHCOMM - Contact Form')
        ->to('brandon@adstreaminc.com', 'Brandon Pierce')
        ->cc('david@adstreaminc.com', 'David Webber')
        ->subject('Contact Form Submission From ' . $fields['first_name'] . ' ' . $fields['last_name']);
    });

    return View::make('frontend.static.thanks');
  }
}

