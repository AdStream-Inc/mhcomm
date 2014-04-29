<?php namespace Adstream\Models;

use Laracasts\Presenter\PresentableTrait;
use Way\Database\Model;
use Adstream\Models\PageSections;

/**
 * Model is the class used for auto validation
 * See https://github.com/JeffreyWay/Laravel-Model-Validation
 */
class Pages extends Model {

    use PresentableTrait;

    /**
     * Our presenter object
     */
    protected $presenter = 'PagesPresenter';

    /**
     * Explicitly tell laravel what table to look for
     */
    protected $table = 'pages';

    /**
     * What table columns can be mass assigned
     * See http://laravel.com/docs/eloquent#mass-assignment
     */
    protected $fillable = array('name', 'slug', 'template', 'enabled', 'auth_only', 'parent_id');

    /**
     * Auto validation rules for composer package Way/Database
     */
    protected static $rules = array();

    public function section($slug = '')
    {
        $section = PageSections::where('page_id', $this->id)->where('slug', $slug)->first();

        if ($section) return $section->content;

        return '';
    }

    public function sections()
    {
        return $this->hasMany('Adstream\Models\PageSections', 'page_id');
    }

    public function tree() 
    {
      return $this->hasOne('Adstream\Models\PageTree', 'page_id');
    }
}