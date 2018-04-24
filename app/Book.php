<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Author;

class Book extends Model
{

    protected $table = 'books';
    public $timestamps = true;
    protected $fillable = [
        'title',
        'author',
        'google_id',
        'description',
        'slug',
        'page_count',
        'image'
    ];

    /**
    * Get all of the books on the current users reading list.
    */
    public function subscribedBooks()
    {
        return $this->hasMany('App\BookSubscription');
    }

    /**
    * Get all of the books on the current users reading list.
    */
    public function author()
    {
        return $this->belongsTo('App\Author', 'author_id');

    }

}
