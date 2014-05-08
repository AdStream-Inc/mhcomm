<?php

use Adstream\Models\Revisions as Revisions;

View::composer('*', function($view) {
  $view->with('adminUrl', Config::get('site.admin_url'));
  $view->with('siteTitle', Config::get('site.title'));

  if (Config::get('site.installed')) {
    if (Sentry::getUser()) {
      $view->with('authUser', Sentry::getUser());

      $managers = Sentry::findGroupByName('Manager');
      $users = Sentry::findAllUsersInGroup($managers)->lists('id');
  
  	if (!empty($users)){
  
		  $specialsRevisionCount = Revisions::where('revisionable_type', 'Adstream\Models\Specials')
									->where('approved', false)
									->whereIn('user_id', $users)
									->count();
		  $communitiesRevisionCount = Revisions::where('revisionable_type', 'Adstream\Models\Communities')
									->where('approved', false)
									->whereIn('user_id', $users)
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