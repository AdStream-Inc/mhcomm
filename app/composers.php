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

      $superManagers = Sentry::findGroupByName('Super Manager');
      $isSuperManager = $user->inGroup($superManagers);
      $view->with('isSuperManager', $isSuperManager);

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

        $communityRevisionCount = Revisions::where(function($query) {
                    $query->where('revisionable_type', 'Adstream\Models\Communities')
                          ->orWhere('revisionable_type', 'Adstream\Models\CommunityEvents');
                  })
                  ->where('approved', false)
                  ->whereIn('user_id', $users)
                  ->groupBy('group_hash')
                  ->get()->count();

        $communityImageRevisionCount = Revisions::where('revisionable_type', 'Adstream\Models\CommunityImages')
                  ->where('approved', false)
                  ->whereIn('user_id', $users)
                  ->groupBy('group_hash')
                  ->get()->count();

        $communityPagesRevisionCount = Revisions::where(function($query) {
                    $query->where('revisionable_type', 'Adstream\Models\CommunityPageSections')
                          ->orWhere('revisionable_type', 'Adstream\Models\CommunityPages');
                  })
                  ->where('approved', false)
                  ->whereIn('user_id', $users)
                  ->groupBy('group_hash')
                  ->get()->count();
      } else {
        $specialsRevisionCount = 0;
        $communityRevisionCount = 0;
		    $communityImageRevisionCount = 0;
        $communityPagesRevisionCount = 0;
      }

      $view->with('communityRevisions', $communityRevisionCount);
      $view->with('specialsRevisions', $specialsRevisionCount);
      $view->with('communityImageRevisions', $communityImageRevisionCount);
      $view->with('communityPagesRevisions', $communityPagesRevisionCount);
    }
  }
});