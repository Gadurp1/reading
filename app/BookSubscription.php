<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BookSubscription;

class BookSubscription extends Model
{

    protected $table = 'book_subscriptions';
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
