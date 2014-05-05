<?php

View::composer('*', function($view) {
  $view->with('adminUrl', Config::get('site.admin_url'));
  $view->with('siteTitle', Config::get('site.title'));
  if (Config::get('site.installed')) {
    if (Sentry::getUser()) {
      $view->with('authUser', Sentry::getUser());
    }
  }
});