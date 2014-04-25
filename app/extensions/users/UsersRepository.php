<?php namespace Adstream\Models;

use Cartalyst\Sentry\Users\Eloquent\User as SentryUser;
use Laracasts\Presenter\PresentableTrait;

class User extends SentryUser {

  use PresentableTrait;

  protected $presenter = 'UserPresenter';

}