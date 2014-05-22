<?php namespace Adstream\Models;

use Cartalyst\Sentry\Users\Eloquent\User as SentryUser;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends SentryUser implements RemindableInterface {

  use PresentableTrait;

  protected $presenter = 'UserPresenter';

  public function communities()
  {
    return $this->belongsToMany('\Adstream\Models\Communities', 'communities_users', 'community_id', 'user_id');
  }

  public function specials()
  {
    return $this->community->with('specials');
  }

  public function getReminderEmail()
  {
      return $this->email;
  }

}