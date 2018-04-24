<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{

    protected $table = 'authors';
    public $timestamps = true;
    protected $fillable = [
        'first_name',
        'last_name',
    ];

    /**
    * Get all of the books on the current users reading list.
    */
    public function book()
    {
      return $this->belongsToMany('App\Book');
    }

    public function hasGoogleLink()
    {
        return $this->google_id;
    }

}
