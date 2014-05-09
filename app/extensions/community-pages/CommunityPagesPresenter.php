<?php

use Laracasts\Presenter\Presenter;

class CommunityPagesPresenter extends Presenter {

  public function createdOn()
  {
    return date('M d, Y', strtotime($this->created_at));
  }

  public function isEnabled()
  {
    return $this->enabled ? 'Yes' : 'No';
  }

}