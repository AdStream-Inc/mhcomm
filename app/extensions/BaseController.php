<?php namespace Adstream\Controllers;

use Config;
use Sentry;

class BaseController extends \Controller {

  public $adminUrl;

  public $user;

  public $isManager;

  public function __construct()
  {
    $this->adminUrl = Config::get('site.admin_url');
    if (Sentry::getUser()) {
      $this->user = Sentry::getUser();
      $managerGroup = Sentry::findGroupByName('Manager');
      $superManagerGroup = Sentry::findGroupByName('Super Manager');
      $this->isManager = $this->user->inGroup($managerGroup);
      $this->isSuperManager = $this->user->inGroup($superManagerGroup);
    }
  }
}