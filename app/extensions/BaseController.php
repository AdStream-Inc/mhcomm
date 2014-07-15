<?php namespace Adstream\Controllers;

use Config;
use Sentry;
use DB;

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

  public function saveApplication($data) {
    DB::table('applicants')->insert($data);
  }

  public function getApplications($fromData, $toDate) {

  }
}