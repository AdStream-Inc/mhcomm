<?php namespace Adstream\Models;

use Laracasts\Presenter\PresentableTrait;

class Jobs extends BaseRepository {

    use PresentableTrait;

    /**
     * Our presenter object
     */
    protected $presenter = 'JobsPresenter';

    /**
     * Explicitly tell laravel what table to look for
     */
    protected $table = 'jobs';

    /**
     * What table columns can be mass assigned
     * See http://laravel.com/docs/eloquent#mass-assignment
     */
    protected $fillable = array('name', 'description', 'enabled', 'qualifications');

    /**
     * Auto validation rules
     */
    protected static $rules = array(
      'name' => 'required',
      'description' => 'required',
      'qualifications' => 'required'
    );
}