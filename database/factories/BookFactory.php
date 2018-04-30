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

$factory->define(App\Book::class, function (Faker $faker) {
    $author = factory(App\Author::class)->create();
    return [
        'title' => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'author_id' => $author->id,
        'image' => $faker->imageUrl('400', '280', 'cats', true, 'Faker'),
        'google_id' => $faker->ean8,
        'description' => $faker->paragraph($nbSentences = 7, $variableNbSentences = true) ,
        'page_count' => $faker->numberBetween($min = 200, $max = 2090, $function = 'sqrt')
    ];
});
