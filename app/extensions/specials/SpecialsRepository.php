<?php namespace Adstream\Models;

use Laracasts\Presenter\PresentableTrait;
use Way\Database\Model;

/**
 * Model is the class used for auto validation
 * See https://github.com/JeffreyWay/Laravel-Model-Validation
 */
class Specials extends Model {

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
     * Auto validation rules for composer package Way/Database
     */
    protected static $rules = array(
      'name' => 'required',
      'content' => 'required'
    );

    public function communities()
    {
        return $this->belongsToMany('Adstream\Models\Communities', 'communities_specials');
    }
}