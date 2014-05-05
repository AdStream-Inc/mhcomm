<?php namespace Adstream\Models;

use Sentry;
use Laracasts\Presenter\PresentableTrait;
use Way\Database\Model;
use Adstream\Models\User;

/**
 * Model is the class used for auto validation
 * See https://github.com/JeffreyWay/Laravel-Model-Validation
 */
class Communities extends Model {

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
    protected $fillable = array('name', 'address', 'city', 'state', 'zip', 'phone', 'email', 'description', 'amenities', 'benefits', 'points_of_interest', 'office_hours', 'license_number', 'enabled', 'map_address', 'manager_id');

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
	  'email' => 'required|email',
	  'description' => 'required',
    );

	public function specials()
    {
        return $this->belongsToMany('Adstream\Models\Specials', 'communities_specials');
    }

    public function manager()
    {
        $user = Sentry::getUser();
        $manager = Sentry::findGroupByName('Manager');

        if ($user->inGroup($manager)) {
          return $this->belongsTo('User', 'manager_id');
        }
    }

    /**
     * Todo still
     */
    public static function boot() {
        parent::boot();

        $user = Sentry::getUser();
        $manager = Sentry::findGroupByName('Manager');

        if ($user->inGroup($manager)) {
            static::saving(function($model) {
                dd('test');
                return false;
            });
        }
    }

}