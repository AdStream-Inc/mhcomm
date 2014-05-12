<?php

use Laracasts\Presenter\Presenter;

class CommunitiesPresenter extends Presenter {
  
  public function lastUpdated()
  {
    return date('g:i A, M d, Y', strtotime($this->updated_at));
  }

  public function createdOn()
  {
    return date('g:i A, M d, Y', strtotime($this->created_at));
  }

  public function available()
  {
	  return $this->enabled ? 'Yes' : 'No';
  }
}