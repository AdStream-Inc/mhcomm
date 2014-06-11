<?php

use Laracasts\Presenter\Presenter;

class SpecialsPresenter extends Presenter {

  public function createdOn()
  {
    return date('g:i A, M d, Y', strtotime($this->created_at));
  }

  public function isEnabled()
  {
    return $this->enabled ? 'Yes' : 'No';
  }

  public function isHome()
  {
    return $this->on_homepage ? 'Yes' : 'No';
  }
}