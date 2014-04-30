<?php namespace Adstream\Models;

use Laracasts\Presenter\PresentableTrait;
use Way\Database\Model;

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
    protected $fillable = array('name', 'address', 'city', 'state', 'zip', 'phone', 'email', 'description', 'amenities', 'benefits', 'points_of_interest', 'office_hours', 'license_number', 'enabled');

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
	
	public function specials(){
		
		return $this->hasMany('Specials', 'community_id');
		
	}
	
}