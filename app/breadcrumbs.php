<?php

Breadcrumbs::register('home', function($breadcrumbs) {
  $breadcrumbs->push('Home', url('/'));
});

Breadcrumbs::register('communities', function($breadcrumbs) {
  $breadcrumbs->parent('home');
  $breadcrumbs->push('Communities', url('communities'));
});

Breadcrumbs::register('community', function($breadcrumbs, $page) {
  $breadcrumbs->parent('communities');
  $breadcrumbs->push($page->name, url('communities/' . $page->slug . '.html'));
});