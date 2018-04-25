<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UserBook;

class UserBook extends Model
{
    protected $table = 'user_books';
    public $timestamps = true;

    /**
    * Get all books subscribed to.
    */
    public function user()
    {
       return $this->hasOne('App\User');
    }

    /**
    * Get all books subscribed to.
    */
    public function book()
    {
       return $this->belongsTo('App\Book');
    }
}
