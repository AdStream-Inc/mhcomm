<?php namespace Adstream\Controllers;

use Config;

class BaseController extends \Controller {

  public $adminUrl;

  public function __construct()
  {
    $this->adminUrl = Config::get('site.admin_url');
  }
}