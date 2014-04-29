<?php namespace Adstream\Models;

use Laracasts\Presenter\PresentableTrait;
use Way\Database\Model;

/**
 * Model is the class used for auto validation
 * See https://github.com/JeffreyWay/Laravel-Model-Validation
 */
class PageSections extends Model {

    /**
     * Explicitly tell laravel what table to look for
     */
    protected $table = 'page_sections';

    /**
     * What table columns can be mass assigned
     * See http://laravel.com/docs/eloquent#mass-assignment
     */
    protected $fillable = array('content', 'slug', 'page_id');

    /**
     * Auto validation rules for composer package Way/Database
     */
    protected static $rules = array();

    public function page()
    {
        return $this->belongsTo('Adstream\Models\Pages', 'page_id');
    }
}