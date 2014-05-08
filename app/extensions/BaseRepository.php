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
  protected static function boot()
  {
    parent::boot();

    static::saving(function($model) {
      if ($model->isRevisionable) {
        $user = Sentry::getUser();
        $manager = Sentry::findGroupByName('Manager');

        if ($user->inGroup($manager)) {
          $model->saveRevision();

          // keep old data values until new value is approved
          foreach ($model->originalData as $key => $value) {
            $model[$key] = $value;
          }

          return $model->validate();
        } else {
          $model->saveRevision();

          return $model->validate();
        }
      } else {
        return $model->validate();
      }
    });
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
  private function saveRevision()
  {
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
      foreach ($changes as $key => $change) {
          $revisions[] = array(
              'revisionable_type'     => get_class($this),
              'revisionable_id'       => $this->getKey(),
              'key'                   => $key,
              'old_value'             => array_get($this->originalData, $key),
              'new_value'             => $this->updatedData[$key],
              'user_id'               => Sentry::getUser()->id,
              'created_at'            => new \DateTime(),
              'updated_at'            => new \DateTime(),
              'group_hash'            => $groupHash
          );
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