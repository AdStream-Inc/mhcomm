<?php

use Laracasts\Presenter\Presenter;

class RevisionsPresenter extends Presenter {

  public function createdOn()
  {
    return date('g:i A, M d, Y', strtotime($this->created_at));
  }

}