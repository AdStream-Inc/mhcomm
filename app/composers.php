<?php

View::composer('*', function($view) {
  $view->with('adminUrl', Config::get('site.admin_url'));
  $view->with('siteTitle', Config::get('site.title'));
  if (Sentry::getUser()) {
    $view->with('user', Sentry::getUser());
  }
});