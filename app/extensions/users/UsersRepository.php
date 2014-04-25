<?php namespace Adstream\Models;

use Input;
use Validator;
use Cartalyst\Sentry\Users\Eloquent\User as SentryUser;

class Users extends SentryUser {

    protected static $rules = array(
      'first_name' => 'required',
      'last_name' => 'required',
      'password' => 'required',
      'email' => 'required|email'
    );

}