<?php namespace Adstream\Controllers;

use Config;
use Sentry;

class BaseController extends \Controller {

  public $adminUrl;

  public $user;

  public function __construct()
  {
    $this->adminUrl = Config::get('site.admin_url');
    if (Sentry::getUser()) {
      $this->user = Sentry::getUser();
      $managerGroup = Sentry::findGroupByName('Manager');
      $this->isManager = $this->user->inGroup($managerGroup);
    }
  }
}