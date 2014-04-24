<?php namespace Adstream\Models;

class Jobs extends \Model {

    protected $table = 'jobs';

    protected $guarded = array();

    protected $fillable = array('name', 'description', 'enabled', 'qualifications');

    protected static $rules = array(
      'name' => 'required',
      'description' => 'required',
      'qualifications' => 'required'
    );
}