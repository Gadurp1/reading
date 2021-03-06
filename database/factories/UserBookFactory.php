<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\UserBook::class, function (Faker $faker) {
    $book = factory(App\Book::class)->create();
    $user = factory(App\User::class)->create();

    return [
        'user_id' => $user->id,
        'book_id' => $book->id,
        'order' => $user->subscriptions->count() + 1
    ];
});
