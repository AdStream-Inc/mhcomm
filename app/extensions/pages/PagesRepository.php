<?php namespace Adstream\Models;

use Laracasts\Presenter\PresentableTrait;
use Adstream\Models\PageSections;

/**
 * Model is the class used for auto validation
 * See https://github.com/JeffreyWay/Laravel-Model-Validation
 */
class Pages extends BaseRepository {

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
     * Auto validation rules
     */
    protected static $rules = array(
        'name' => 'required',
    );

    public function section($slug = '')
    {
        $section = PageSections::where('page_id', $this->id)->where('slug', $slug)->first();

        // send empty string if not found to prevent
        // php error from throwing
        return $section ? $section->content : '';
    }

    public function sections()
    {
        return $this->hasMany('Adstream\Models\PageSections', 'page_id');
    }
	
	public function getParents(){
		
		$parents = array();
		
		$parent = $this->parent_id;
		
		while ($parent != 0){
			
			$thisParent = $this->find($parent);
			
			$parents[] = $thisParent;
			$parent = $thisParent->parent_id;
			
		}
		
		return array_reverse($parents);
		
	}

}