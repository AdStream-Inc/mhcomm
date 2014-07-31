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
    array_unshift($communities, 'Im Not Sure');
    return View::make('frontend.static.apply', compact('communities'));
  }

  public function postIndex()
  {
    $fields = array_except(Input::all(), array('_token'));

    // we can only send a coupon if a specified community is added
    if ($fields['community'] != 'Im Not Sure') {
      $community = Communities::where('name', $fields['community'])->first();
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
    }

    $to = array();
    if ($fields['community'] == 'Im Not Sure') {
      $to = explode(',', Config::get('site.generic_application'));
    } else {
      $community = Communities::where('name', $fields['community'])->first();
      $to = $community->users->lists('email');
    }

    Mail::send('emails.apply', $fields, function($message) use ($fields, $to) {
      $message
        ->from($fields['email'], 'MHCOMM - Community Application Form')
        ->to($to)
        ->subject('Community Application Form Submission From ' . $fields['first_name'] . ' ' . $fields['last_name']);
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
}

