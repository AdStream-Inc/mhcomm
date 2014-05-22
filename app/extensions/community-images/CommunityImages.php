<?php namespace Adstream\Models;

use Str;

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
	
	protected $isRevisionable = true;
	protected $revisionableParentType = 'Adstream\Models\Communities';
	protected $parentPrimaryKeyReference = 'community_id';
	
	protected $revisionAttributePresenters = array(
		'path' => 'getImageHtml'
	);
  
  	public function getImageHtml($path = ''){
		
		if (empty($path)) return '<i>No Image</i>';
		
		return '<img width="150" class="media-object img-responsive img-thumbnail push-half-bottom" src="' . $path . '" />';
		
	}
	
}