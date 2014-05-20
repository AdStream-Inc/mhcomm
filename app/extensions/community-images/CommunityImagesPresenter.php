<?php

use Laracasts\Presenter\Presenter;

class CommunityImagesPresenter extends Presenter {

  public function createdOn()
  {
    return date('M d, Y', strtotime($this->created_at));
  }

}