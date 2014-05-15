<?php namespace Adstream\Controllers\Frontend;

use App;
use View;
use Response;
use Str;
use Adstream\Models\Jobs;
use Adstream\Controllers\BaseController;

class JobsController extends BaseController {

  protected $jobs;

  public function __construct(Jobs $jobs){
	  
    $this->jobs = $jobs;
	
  }


  public function index(){
	 
	$jobs = $this->jobs->all();
	  
    return View::make('frontend.jobs.index', compact('jobs'));
	
  }

  public function show($slug){
	  
	  $job = $this->jobs->where('slug', $slug)->firstOrFail();
	  
	  return View::make('frontend.jobs.show', compact('job'));
	  
  }
  
}