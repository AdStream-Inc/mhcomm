<?php namespace Adstream\Controllers\Admin;

use View;
use Config;
use Redirect;
use Adstream\Controllers\BaseController;
use Adstream\Models\User;
use Adstream\Models\Pages;
use Adstream\Models\Jobs;
use Adstream\Models\Communities;
use Adstream\Models\Specials;

class DashboardController extends BaseController {

  protected $pages;

  protected $users;

  protected $jobs;

  protected $communities;

  protected $specials;

  public function __construct(Pages $pages, User $users, Jobs $jobs, Communities $communities, Specials $specials)
  {
    parent::__construct();
    $this->pages = $pages;
    $this->users = $users;
    $this->jobs = $jobs;
    $this->communities = $communities;
    $this->specials = $specials;
  }

  public function getIndex()
  {
    if ($this->isManager) {
      return Redirect::route(Config::get('site.admin_url') . '.communities.index');
    }

    $recentPages = $this->pages->orderBy('created_at')->take(5)->get();
    $pagesCount = $this->pages->count();

    $recentJobs = $this->jobs->orderBy('created_at')->take(5)->get();
    $jobsCount = $this->jobs->count();

    $recentUsers = $this->users->where('first_name', '!=', 'Adstream')->orderBy('created_at')->take(5)->get();
    $usersCount = $this->users->count() - 1; // take into account adstream user

    $recentCommunities = $this->communities->orderBy('created_at')->take(5)->get();
    $communitiesCount = $this->communities->count();

    $recentSpecials = $this->specials->orderBy('created_at')->take(5)->get();
    $specialsCount = $this->specials->count();

    return View::make('admin.dashboard', compact(
      'recentPages',
      'recentUsers',
      'recentJobs',
      'pagesCount',
      'usersCount',
      'jobsCount',
      'communitiesCount',
      'recentCommunities',
      'recentSpecials',
      'specialsCount'
    ));
  }

}