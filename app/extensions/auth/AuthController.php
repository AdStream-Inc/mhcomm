<?php namespace Adstream\Controllers\Admin;

use View;
use Input;
use Redirect;
use Sentry;
use Alert;
use Adstream\Controllers\BaseController;

class AuthController extends BaseController {

  public function getIndex()
  {
    return Redirect::to($this->adminUrl . '/auth/login');
  }

  public function getLogin()
  {
    return View::make('admin.auth.login');
  }

  public function postLogin()
  {
    try {
      // Set login credentials
      $credentials = array(
          'email'    => Input::get('email'),
          'password' => Input::get('password'),
      );

      // Try to authenticate the user
      if (Input::get('remember_me')) {
        Sentry::authenticateAndRemember($credentials);
      } else {
        Sentry::authenticate($credentials, false);
      }

      return Redirect::to($this->adminUrl . '/settings');

    } catch (\Cartalyst\Sentry\Users\LoginRequiredException $e) {
      Alert::error('Email field is required.')->flash();
      return Redirect::to($this->adminUrl . '/auth/login');
    } catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e) {
      Alert::error('Password field is required.')->flash();
      return Redirect::to($this->adminUrl . '/auth/login');
    } catch (\Cartalyst\Sentry\Users\WrongPasswordException $e) {
      Alert::error('Wrong password, try again.')->flash();
      return Redirect::to($this->adminUrl . '/auth/login');
    } catch (\Cartalyst\Sentry\Users\UserNotFoundException $e) {
      Alert::error('User was not found.')->flash();
      return Redirect::to($this->adminUrl . '/auth/login');
    } catch (\Cartalyst\Sentry\Users\UserNotActivatedException $e) {
      Alert::error('User is not activated.')->flash();
      return Redirect::to($this->adminUrl . '/auth/login');
    }
  }

  public function getLogout()
  {
    Sentry::logout();
    return Redirect::to($this->adminUrl . '/auth/login');
  }

}