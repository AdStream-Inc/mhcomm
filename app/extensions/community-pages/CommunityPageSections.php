<?php namespace Adstream\Models;

use Laracasts\Presenter\PresentableTrait;

class CommunityPageSections extends BaseRepository {

    protected $isRevisionable = true;
    protected $revisionableParentType = 'Adstream\Models\CommunityPages';
    protected $parentPrimaryKeyReference = 'page_id';

    /**
     * Explicitly tell laravel what table to look for
     */
    protected $table = 'community_page_sections';

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
        return $this->belongsTo('Adstream\Models\CommunityPages', 'page_id');
    }
}