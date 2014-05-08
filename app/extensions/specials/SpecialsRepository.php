<?php namespace Adstream\Models;

use Laracasts\Presenter\PresentableTrait;
use Sentry;

class Specials extends BaseRepository {

    protected $isRevisionable = true;

    use PresentableTrait;

    /**
     * Our presenter object
     */
    protected $presenter = 'SpecialsPresenter';

    /**
     * Explicitly tell laravel what table to look for
     */
    protected $table = 'specials';

    /**
     * What table columns can be mass assigned
     * See http://laravel.com/docs/eloquent#mass-assignment
     */
    protected $fillable = array('name', 'content', 'enabled', 'sort_order');

    /**
     * Auto validation rules
     */
    protected static $rules = array(
      'name' => 'required',
      'content' => 'required'
    );

    public function communities()
    {
        return $this->belongsToMany('Adstream\Models\Communities', 'communities_specials');
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
}