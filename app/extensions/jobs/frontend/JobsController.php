<?php namespace Adstream\Controllers\Frontend;

use View;
use Adstream\Models\Jobs;
use Adstream\Controllers\BaseController;

class JobsController extends BaseController {

  protected $jobs;

  public function __construct(Jobs $jobs)
  {
    $this->jobs = $jobs;
  }

  public function index()
  {
	  $jobs = $this->jobs->paginate(1);
    return View::make('frontend.jobs.index', compact('jobs'));
  }

  public function show($slug)
  {
	  $job = $this->jobs->where('slug', $slug)->firstOrFail();
	  return View::make('frontend.jobs.show', compact('job'));
  }
}