<?php

use Adstream\Controllers\BaseController;
use Adstream\Models\Communities;
use Adstream\Models\Coupon;

class ApplyController extends BaseController {

  private $communities;

  public function __construct(Communities $communities, Coupon $coupon)
  {
    $this->communities = $communities;
    $this->coupon = $coupon;
  }

  public function getIndex()
  {
    $communities = $this->communities->lists('name', 'name');
    return View::make('frontend.static.apply', compact('communities'));
  }

  public function postIndex()
  {
    $fields = array_except(Input::all(), array('_token'));
    $community = Communities::where('name', $fields['community'])->first();

    Mail::send('emails.apply', $fields, function($message) use ($fields) {
      $message
        ->from('test@mhcomm.com', 'MHCOMM - Community Application Form')
        ->to('brandon@adstreaminc.com')
        ->subject('Community Application Form Submission From ' . $fields['first_name'] . ' ' . $fields['last_name']);
    });

    $content = $this->coupon->first()->content;
    $couponData = array(
      'phone' => $community->phone,
      'location' => $fields['community'],
      'content' => $content
    );

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

    Mail::send('emails.coupon', $couponData, function($message) use ($fields) {
      $message
        ->from('test@mhcomm.com', 'MHCOMM - Application Coupon')
        ->to('brandon@adstreaminc.com')
        ->subject('Community Application Coupon');
    });

    return View::make('frontend.static.apply-thanks', compact('couponData'));
  }
}

