<?php namespace Adstream\Models;

use Cartalyst\NestedSets\Nodes\EloquentNode as NestedSet;

class PageTree extends NestedSet {

  protected $table = 'page_tree';

  protected $fillable = array('page_id');

  protected $reservedAttributes = array(
      // The left column limit. "left" is a reserved word in SQL
      // databases so we default to "lft" for compatiblity.
      'left'  => 'lft',

      // The right column limit. "right" is a reserved word in SQL
      // databases so we default to "rgt" for compatiblity.
      'right' => 'rgt',

      // The tree that the node is on. This package supports multiple
      // trees within one database.
      'tree'  => 'tree',
  );

  /**
   * The worker class which the model uses.
   *
   * @var string
   */
  protected $worker = 'Cartalyst\NestedSets\Workers\IlluminateWorker';

  public function page()
  {
    return $this->belongsTo('Adstream\Models\Pages', 'page_id');
  }
}