<?php

use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter {

  public function fullName()
  {
    return $this->first_name . ' ' . $this->last_name;
  }

  public function createdOn()
  {
    return date('M d, Y', strtotime($this->created_at));
  }

  public function lastLogin()
  {
    return date('M d, Y', strtotime($this->last_login));
  }

}