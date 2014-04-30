<?php

use Laracasts\Presenter\Presenter;

class CommunitiesPresenter extends Presenter {

  public function createdOn()
  {
    return date('M d, Y', strtotime($this->created_at));
  }

  public function available()
  {
    return $this->enabled ? 'Yes' : 'No';
  }
}