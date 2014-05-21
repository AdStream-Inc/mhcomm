<?php namespace Adstream\Models;

use Cartalyst\Sentry\Users\Eloquent\User as SentryUser;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends SentryUser implements RemindableInterface {

  use PresentableTrait;

  protected $presenter = 'UserPresenter';

  public function community()
  {
    return $this->hasMany('\Adstream\Models\Communities', 'manager_id');
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