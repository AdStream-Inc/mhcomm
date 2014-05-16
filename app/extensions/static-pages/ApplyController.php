<?php

use Adstream\Controllers\BaseController;

class ApplyController extends BaseController {
  
  public function getIndex() {
	  
    return View::make('frontend.static.apply');
  }

  public function postIndex() {
	  
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

