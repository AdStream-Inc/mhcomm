<?php namespace Adstream\Controllers\Admin;

use View;
use Input;
use Redirect;
use Alert;
use Adstream\Controllers\BaseController;
use Adstream\Models\Coupon;

class CouponController extends BaseController {

  protected $model;

  public function __construct(Coupon $coupon)
  {
    parent::__construct();
    $this->model = $coupon;
  }

  public function index()
  {
    $coupon = $this->model->first();

    if (!$coupon) {
      $coupon = $this->model->create(array('content' => 'Sample content'));
    }

    $content = $coupon->content;
    return View::make('admin.coupon.index', compact('content'));
  }

  public function store()
  {
    $coupon = $this->model->first();
    $coupon->content = Input::get('content');

    if ($coupon->save()) {
      Alert::success('Coupon successfully updated!')->flash();
      return Redirect::route($this->adminUrl . '.coupon.index');
    }

    return Redirect::back()->withInput()->withErrors($coupon->getErrors());
  }
}