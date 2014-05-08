<?php namespace Adstream\Models;

use Laracasts\Presenter\PresentableTrait;

class PageSections extends BaseRepository {

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
     * Auto validation rules
     */
    protected static $rules = array();

    public function page()
    {
        return $this->belongsTo('Adstream\Models\Pages', 'page_id');
    }
}