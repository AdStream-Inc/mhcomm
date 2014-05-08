<?php namespace Adstream\Models;

use Laracasts\Presenter\PresentableTrait;
use Str;
use Sentry;

class Revisions extends BaseRepository {

    use PresentableTrait;

    /**
     * Our presenter object
     */
    protected $presenter = 'RevisionsPresenter';

    protected $table = 'revisions';

    public function revisionable()
    {
        return $this->morphTo();
    }

    public function getKeyAttribute($value)
    {
      return ucfirst(str_replace('-', ' ', Str::slug($value)));
    }

    public function user()
    {
      return $this->belongsTo('Adstream\Models\User', 'user_id');
    }
}