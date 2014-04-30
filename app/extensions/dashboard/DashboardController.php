<?php namespace Adstream\Controllers\Admin;

use View;
use Adstream\Controllers\BaseController;
use Adstream\Models\User;
use Adstream\Models\Pages;
use Adstream\Models\Jobs;

class DashboardController extends BaseController {

  protected $pages;

  protected $users;

  protected $jobs;

  public function __construct(Pages $pages, User $users, Jobs $jobs)
  {
    $this->pages = $pages;
    $this->users = $users;
    $this->jobs = $jobs;
  }

  public function getIndex()
  {
    $recentPages = $this->pages->orderBy('created_at')->take(5)->get();
    $pagesCount = $this->pages->count();

    $recentJobs = $this->jobs->orderBy('created_at')->take(5)->get();
    $jobsCount = $this->jobs->count();

    $recentUsers = $this->users->orderBy('created_at')->take(5)->get();
    $usersCount = $this->users->count();

    return View::make('admin.dashboard', compact('recentPages', 'recentUsers', 'recentJobs', 'pagesCount', 'usersCount', 'jobsCount'));
  }

}