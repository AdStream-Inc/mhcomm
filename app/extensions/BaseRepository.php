<?php namespace Adstream\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Validation\Validator;
use Sentry;
use DB;

class BaseRepository extends Eloquent {
  /**
   * Error message bag
   * @var Illuminate\Support\MessageBag
   */
  protected $errors;

  /**
   * Validation rules
   * @var Array
   */
  protected static $rules = array();

  /**
   * Validator instance
   * @var Illuminate\Validation\Validators
   */
  protected $validator;

  /**
   * Do we want to track revisions?
   * @var boolean
   */
  protected $isRevisionable = false;

  /**
   * Original data from saving model
   * @var Array
   */
  private $originalData;

  /**
   * Updated data from saving model
   * @var Array
   */
  private $updatedData;

  /**
   * Dirty data from saving model
   * @var Array
   */
  private $dirtyData;

  public function __construct(array $attributes = array(), Validator $validator = null)
  {
    parent::__construct($attributes);

    $this->validator = $validator ?: \App::make('validator');
  }

  /**
   * Listen for save event
   */
  protected static function boot(){
	  
    parent::boot();
	
	static::creating(function($model) {
		
		return $model->executeRevisionObserver('creating');
		
	});
	
    static::updating(function($model) {
		
		return $model->executeRevisionObserver('updating');
	  
    });
	
	static::deleting(function($model) {

		return $model->executeRevisionObserver('deleting');

	});
	
  }
  
  
  private function executeRevisionObserver($action = null){
	  
	  if (empty($action)) return false;
	  
      if ($this->isRevisionable) {
		  
        $user = Sentry::getUser();
        $manager = Sentry::findGroupByName('Manager');

        if ($user->inGroup($manager)) {
			
		  //if the data is valid, validate will return null
	      $isValid = $this->validate() === null ? true : false;
		  
		  if ($isValid || $action == 'deleting'){
			  
			  $this->saveRevision($action);
		  
			  // keep old data values until new value is approved
			  foreach ($this->originalData as $key => $value) {
				$this[$key] = $value;
			  }
			  
			  $this->revisionPending = true;
			  
		  }
		  
		  return false;
		  
        } else {

          return $this->validate();
		  
        }
		
      } else {
		  
        return $this->validate();
		
      }
	  
  }

  /**
   * Validates current attributes against rules
   */
  public function validate()
  {
    $v = $this->validator->make($this->attributes, static::$rules);

    if ($v->passes()) {
        return null; // this allows the event to pass through to other handlers
    }

    $this->setErrors($v->messages());

    return false;
  }

  /**
   * Saves a revision of the changes on the model
   */
  private function saveRevision($action = null){
	  
	  if (empty($action)) return;
	  
      $this->originalData = $this->original;
      $this->updatedData  = $this->attributes;
      $this->dirtyData = $this->getDirty();
      $changes = array();

      // we can only safely compare basic items,
      // so for now we drop any object based items, like DateTime
      foreach ($this->updatedData as $key => $val) {
          if (gettype($val) == 'object') {
              unset($this->originalData[$key]);
              unset($this->updatedData[$key]);
          }
      }

      foreach ($this->dirtyData as $key => $value) {
          if (!isset($this->originalData[$key]) || $this->originalData[$key] != $this->updatedData[$key]) {
              $changes[$key] = $value;
          } else {
              // we don't need these any more, and they could
              // contain a lot of data, so lets trash them.
              unset($this->updatedData[$key]);
              unset($this->originalData[$key]);
          }
      }

      $revisions = array();
      $groupHash = str_random(20);
	  $userId = Sentry::getUser()->id;
	  
	  $parentType = '';
	  $parentId = '';
	  
	  if ($this->revisionableParentType && $this->parentPrimaryKeyReference){
		  
		  $parentType = $this->revisionableParentType;
		  
		  $primaryKey = $this->parentPrimaryKeyReference;
		  
		  $parentId = isset($changes[$primaryKey]) && !empty($changes[$primaryKey]) ? $changes[$primaryKey] : (isset($this->original[$primaryKey]) && !empty($this->original[$primaryKey]) ? $this->original[$primaryKey] : null);
		  
	  }
	  
	  //sort of a hack. if it's a delete and they didn't make any other changes the revision won't be stored
	  //because the data technically didn't 'change'. we add a random value to the $changes array so we still
	  //save the revision. it doesn't actually get saved, because the controller on the other end checks the action
	  //and just deletes the model
	  if ($action == 'deleting'){
		  
		  $changes = array();
		  
		  $this->originalData['deleted'] = true;
		  $this->updatedData['deleted'] = true;
		  $changes['deleted'] = true;
		  
	  }
	  
      foreach ($changes as $key => $change) {
		  
		  $presenter = isset($this->revisionAttributePresenters) && isset($this->revisionAttributePresenters[$key]) ? $this->revisionAttributePresenters[$key] : '';
		  
          $revisions[] = array(
              'revisionable_type'     => get_class($this),
			  'parent_type'           => $parentType,
			  'parent_id'             => $parentId,
              'revisionable_id'       => $this->getKey(),
              'key'                   => $key,
              'old_value'             => array_get($this->originalData, $key),
              'new_value'             => $this->updatedData[$key],
              'user_id'               => $userId,
              'created_at'            => new \DateTime(),
              'updated_at'            => new \DateTime(),
              'group_hash'            => $groupHash,
			  'action'				  => $action,
			  'presenter'			  => $presenter
          );
		  
		  DB::table('revisions')
		  	  ->where('revisionable_type', get_class($this))
		  	  ->where('revisionable_id', $this->getKey())
			  ->where('revisionable_id', '<>', 0)
			  ->where('user_id', $userId)
			  ->where('key', $key)
			  ->where('approved', 0)
			  ->delete();
      }

      if (count($revisions)) {
          DB::table('revisions')->insert($revisions);
      }
  }

  /**
   * Set error message bag
   *
   * @var Illuminate\Support\MessageBag
   */
  protected function setErrors($errors)
  {
    $this->errors = $errors;
  }

  /**
   * Retrieve error message bag
   */
  public function getErrors()
  {
    return $this->errors;
  }

  /**
   * Inverse of wasSaved
   */
  public function hasErrors()
  {
    return ! empty($this->errors);
  }
}