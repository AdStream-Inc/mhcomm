<?php namespace Adstream\Models;

class CommunityImages extends BaseRepository {
    /**
     * Explicitly tell laravel what table to look for
     */
    protected $table = 'community_images';

    /**
     * What table columns can be mass assigned
     * See http://laravel.com/docs/eloquent#mass-assignment
     */
    protected $fillable = array('name', 'slug', 'community_id', 'path');
}