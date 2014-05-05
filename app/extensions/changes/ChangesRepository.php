<?php namespace Adstream\Models;

use Laracasts\Presenter\PresentableTrait;
use Way\Database\Model;

/**
 * Model is the class used for auto validation
 * See https://github.com/JeffreyWay/Laravel-Model-Validation
 */
class Changes extends Model {

    // use PresentableTrait;

    /**
     * Our presenter object
     */
    // protected $presenter = 'PagesPresenter';

    /**
     * Explicitly tell laravel what table to look for
     */
    protected $table = 'community_changes';

    /**
     * What table columns can be mass assigned
     * See http://laravel.com/docs/eloquent#mass-assignment
     */
    protected $fillable = array('community_id', 'user_id', 'before_value', 'after_value', 'approved', 'column_key');

}