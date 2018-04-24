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

    /**
    * Get all books subscribed to.
    */
    public function reorder($values)
    {
        $table = BookSubscription::getModel()->getTable();

        $cases = [];
        $ids = [];
        $params = [];

        foreach ($values as $id => $value) {
           $id = (int) $id;
           $cases[] = "WHEN {$id} then ?";
           $params[] = $value;
           $ids[] = $id;
        }

        $ids = implode(',', $ids);
        $cases = implode(' ', $cases);
        $params[] = Carbon::now();

        return \DB::update("UPDATE `{$table}` SET `value` = CASE `id` {$cases} END WHERE `id` in ({$ids})", $params);
    }
}
