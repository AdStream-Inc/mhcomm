<?php namespace Adstream\Models;

use Laracasts\Presenter\PresentableTrait;
use Way\Database\Model;

/**
 * Model is the class used for auto validation
 * See https://github.com/JeffreyWay/Laravel-Model-Validation
 */
class Jobs extends Model {

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
     * Auto validation rules for composer package Way/Database
     */
    protected static $rules = array(
      'name' => 'required',
      'description' => 'required',
      'qualifications' => 'required'
    );
}