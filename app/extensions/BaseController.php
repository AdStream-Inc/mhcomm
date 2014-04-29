<?php namespace Adstream\Controllers;

use Config;
use Sentry;

class BaseController extends \Controller {

  public $adminUrl;

  public $user;

  public function __construct()
  {
    $this->adminUrl = Config::get('site.admin_url');
    $this->user = Sentry::getUser();
  }
}