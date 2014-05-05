<?php namespace Adstream\Models;

use Cartalyst\Sentry\Users\Eloquent\User as SentryUser;
use Laracasts\Presenter\PresentableTrait;
use Sentry;

class User extends SentryUser {

  use PresentableTrait;

  protected $presenter = 'UserPresenter';

  public function community()
  {
    return $this->hasOne('\Adstream\Models\Communities', 'manager_id');
  }

}