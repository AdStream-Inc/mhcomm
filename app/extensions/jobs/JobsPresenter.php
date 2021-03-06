<?php

use Laracasts\Presenter\Presenter;

class JobsPresenter extends Presenter {

  public function createdOn()
  {
    return date('g:i A, M d, Y', strtotime($this->created_at));
  }

  public function available()
  {
    return $this->enabled ? 'Yes' : 'No';
  }
}