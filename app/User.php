<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Book;
use App\BookSubscription;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
    * Get all of the books on the current users reading list.
    */
    public function readingList()
    {
      return $this->hasMany('App\BookSubscription')
          ->join('books', 'book_subscriptions.book_id', '=', 'books.id')
          ->join('authors', 'books.author_id', '=', 'authors.id');
    }

    /**
    * Get all of the books on the current users reading list.
    */
    public function subscribedBooks()
    {
        return $this->hasManyThrough(
            'App\BookSubscription',
            'App\Book',
            'book_subscriptions.user_id',
            'book_id',
            'id',
            'id'
        );
    }

    /**
    * Get all of the books on the current users reading list.
    */
    public function subscriptions()
    {
        return $this->hasMany(
            'App\BookSubscription', 'user_id'
        );
    }

    /**
    * Add book to a users subscriptions.
    */
    public function subscribeToBook($book_id)
    {
        $sub = new BookSubscription;
        $sub->user_id = $this->id;
        $sub->book_id = $book_id;
        $sub->order   = $this->subscribedBooks()->count() + 1;
        $sub->save();
    }


    /**
    * Remove book from users readin list
    */
    public function unsubscribeFromBook($book_id)
    {
        $subscription = $this->subscriptions()
            ->where('book_id', $book_id)
            ->first();

        $subscription->delete();
    }
}
