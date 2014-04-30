<?php

return array(
  'adstream' => array(
    'name' => 'Adstream',
    'permissions' => array(
      'superuser' => 1
    )
  ),

  'admin' => array(
    'name'        => 'Admin',
    'permissions' => array(
      'admin' => 1,
      'settings' => 1,
      'users.create' => 1,
      'users.edit' => 1,
      'users.list' => 1,
      'users.delete' => 1,
      'communities.create' => 1,
      'communities.edit' => 1,
      'communities.list' => 1,
      'communities.delete' => 1,
      'pages.create' => 1,
      'pages.edit' => 1,
      'pages.list' => 1,
      'pages.delete' => 1,
      'jobs.create' => 1,
      'jobs.edit' => 1,
      'jobs.list' => 1,
      'jobs.delete' => 1
    ),
  ),

  'superuser' => array(
    'name'        => 'Super User',
    'permissions' => array(
        'admin' => 1,
        'settings' => 0,
        'users.create' => 0,
        'users.edit' => 1,
        'users.list' => 1,
        'users.delete' => 0,
        'communities.create' => 0,
        'communities.edit' => 1,
        'communities.list' => 1,
        'communities.delete' => 0,
        'pages.create' => 0,
        'pages.edit' => 0,
        'pages.list' => 0,
        'pages.delete' => 0,
        'jobs.create' => 0,
        'jobs.edit' => 0,
        'jobs.list' => 0,
        'jobs.delete' => 0,
    ),
  ),

  'supermanager' => array(
    'name'        => 'Super Manager',
    'permissions' => array(
        'admin' => 1,
        'settings' => 0,
        'users.create' => 0,
        'users.edit' => 0,
        'users.list' => 0,
        'users.delete' => 0,
        'communities.create' => 0,
        'communities.edit' => 1,
        'communities.list' => 1,
        'communities.delete' => 0,
        'pages.create' => 0,
        'pages.edit' => 0,
        'pages.list' => 0,
        'pages.delete' => 0,
        'jobs.create' => 0,
        'jobs.edit' => 0,
        'jobs.list' => 0,
        'jobs.delete' => 0,
    ),
  ),

  'manager' => array(
    'name'        => 'Manager',
    'permissions' => array(
        'admin' => 1,
        'settings' => 0,
        'users.create' => 0,
        'users.edit' => 0,
        'users.list' => 0,
        'users.delete' => 0,
        'communities.create' => 0,
        'communities.edit' => 1,
        'communities.list' => 1,
        'communities.delete' => 0,
        'pages.create' => 0,
        'pages.edit' => 0,
        'pages.list' => 0,
        'pages.delete' => 0,
        'jobs.create' => 0,
        'jobs.edit' => 0,
        'jobs.list' => 0,
        'jobs.delete' => 0,
    ),
  ),
);