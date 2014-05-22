<?php namespace Adstream\Models;

use Sentry;
use Laracasts\Presenter\PresentableTrait;
use Adstream\Models\User;

class Communities extends BaseRepository {

    protected $isRevisionable = true;

	protected $revisionAttributePresenters = array(
		'main_image' => 'getImageHtml'
	);

    use PresentableTrait;

    /**
     * Our presenter object
     */
    protected $presenter = 'CommunitiesPresenter';

    /**
     * Explicitly tell laravel what table to look for
     */
    protected $table = 'communities';

    /**
     * What table columns can be mass assigned
     * See http://laravel.com/docs/eloquent#mass-assignment
     */
    protected $fillable = array('name', 'address', 'city', 'state', 'zip', 'phone', 'email', 'description', 'amenities', 'benefits', 'points_of_interest', 'office_hours', 'license_number', 'enabled', 'map_address', 'manager_id', 'main_image');

    /**
     * Auto validation rules for composer package Way/Database
     */
    protected static $rules = array(
      'name' => 'required',
  	  'address' => 'required',
  	  'city' => 'required',
  	  'state' => 'required',
  	  'zip' => 'required',
  	  'phone' => 'required',
  	  'email' => 'required',
  	  'description' => 'required',
      'main_image_file' => 'mimes:jpeg,png,jpg,JPG'
    );

	public function specials()
    {
        return $this->belongsToMany('Adstream\Models\Specials', 'communities_specials');
    }

    public function users()
    {
      return $this->belongsToMany('Adstream\Models\User', 'communities_users', 'community_id', 'user_id');
    }

    public function revisions()
    {
      return $this->morphMany('Adstream\Models\Revisions', 'revisionable');
    }

    public function managerRevisions()
    {
      $managerGroup = Sentry::findGroupByName('Manager');
      $managers = Sentry::findAllUsersInGroup($managerGroup)->lists('id');
      return $this->morphMany('Adstream\Models\Revisions', 'revisionable')
        ->where('approved', false)
        ->whereIn('user_id', $managers);
    }

    public function images()
    {
      return $this->hasMany('Adstream\Models\CommunityImages', 'community_id');
    }

    public function pages()
    {
        return $this->hasMany('Adstream\Models\CommunityPages', 'community_id');
    }

  	public function getPages($parentId = 0){

          $pages = $this->pages()->where('parent_id', '=', $parentId)->get();

  		if (count($pages)) return $pages;

  		return false;

  	}

    public function delete()
    {
      $this->pages()->delete();
      $this->images()->delete();
      $this->revisions()->delete();

      return parent::delete();
    }
	
  	public function getImageHtml($path = ''){
		
		if (empty($path)) return '<i>No Image</i>';
		
		return '<img width="150" class="media-object img-responsive img-thumbnail push-half-bottom" src="' . $path . '" />';
		
	}
}