<?php namespace Adstream\Models;

class Coupon extends BaseRepository {

  /**
   * Explicitly tell laravel what table to look for
   */
  protected $table = 'coupon';

  protected $isRevisionable = true;

  /**
   * What table columns can be mass assigned
   * See http://laravel.com/docs/eloquent#mass-assignment
   */
  protected $fillable = array('content');

  /**
   * Auto validation rules
   */
  protected static $rules = array(
    'content' => 'required'
  );
}