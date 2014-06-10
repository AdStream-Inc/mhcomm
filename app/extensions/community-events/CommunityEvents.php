<?php namespace Adstream\Models;


class CommunityEvents extends BaseRepository {
    /**
     * Explicitly tell laravel what table to look for
     */
    protected $table = 'community_events';

    /**
     * What table columns can be mass assigned
     * See http://laravel.com/docs/eloquent#mass-assignment
     */
    protected $fillable = array('name', 'start_date', 'end_date', 'start_time', 'end_time', 'community_id', 'description', 'recurring');

    protected $isRevisionable = true;
    protected $revisionableParentType = 'Adstream\Models\Communities';
    protected $parentPrimaryKeyReference = 'community_id';
}