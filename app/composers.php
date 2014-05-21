<?php

use Adstream\Models\Revisions as Revisions;

View::composer('*', function($view) {
  $view->with('adminUrl', Config::get('site.admin_url'));
  $view->with('siteTitle', Config::get('site.title'));
});

View::composer(Config::get('site.admin_url') . '*', function($view) {
  if (Config::get('site.installed')) {
    if (Sentry::getUser()) {
      $user = Sentry::getUser();
      $view->with('authUser', $user);

      $managers = Sentry::findGroupByName('Manager');
      $isManager = $user->inGroup($managers);
      $view->with('isManager', $isManager);

      $admins = Sentry::findGroupByName('Admin');
      $isAdmin = $user->inGroup($admins);
      $view->with('isAdmin', $isAdmin);

      $adstream = Sentry::findGroupByName('Adstream');
      $isAdstream = $user->inGroup($adstream);
      $view->with('isAdstream', $isAdstream);

      $users = Sentry::findAllUsersInGroup($managers)->lists('id');
      if (!empty($users)){
        $specialsRevisionCount = Revisions::where('revisionable_type', 'Adstream\Models\Specials')
                  ->where('approved', false)
                  ->whereIn('user_id', $users)
                  ->groupBy('group_hash')
                  ->get()
                  ->count();

        $communitiesRevisionCount = Revisions::where('revisionable_type', 'Adstream\Models\Communities')
                  ->where('approved', false)
                  ->whereIn('user_id', $users)
                  ->groupBy('group_hash')
                  ->get()
                  ->count();
      } else {
        $specialsRevisionCount = 0;
        $communitiesRevisionCount = 0;
      }

      $view->with('communityRevisions', $communitiesRevisionCount);
      $view->with('specialsRevisions', $specialsRevisionCount);
    }
  }
});