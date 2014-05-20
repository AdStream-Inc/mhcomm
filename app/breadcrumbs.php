<?php

Breadcrumbs::register('home', function($breadcrumbs) {
  $breadcrumbs->push('Home', url('/'));
});

Breadcrumbs::register('communities', function($breadcrumbs) {
  $breadcrumbs->parent('home');
  $breadcrumbs->push('Communities', url('communities'));
});

Breadcrumbs::register('community', function($breadcrumbs, $community, $section) {
  $breadcrumbs->parent('communities');
  $breadcrumbs->push($community->name, url('communities/' . $community->slug . '.html'));
  $breadcrumbs->push(ucwords(str_replace('_', ' ', $section)), url('communities/' . $community->slug . '/' . $section . '.html'));
});

Breadcrumbs::register('community_page', function($breadcrumbs, $community, $parents, $page) {
	
	$fullPath = $community->slug;
	
  $breadcrumbs->parent('communities');
  $breadcrumbs->push($community->name, url('communities/' . $fullPath . '.html'));
  
  foreach ($parents as $parent){
		
	  $fullPath .= '/' . $parent->slug;
		
	  $breadcrumbs->push($parent->name, url('communities/' . $fullPath . '.html'));
	  
  }
  
  $breadcrumbs->push($page->name, url('communities/' . $fullPath . '/' . $page->slug . '.html'));
  
});