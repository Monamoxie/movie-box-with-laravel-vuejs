<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\Movie;
use Illuminate\Support\Facades\Storage;

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

$factory->define(Movie::class, function (Faker $faker) {

    $photo = $faker->image(null, 1000, 600, 'people');

    $photoFile = new File($photo);
    $photoFileName = md5(time()) . '.jpg';
    Storage::disk('public_dir')->putFileAs('images', $photoFile, $photoFileName);
    return [
        'title' => $faker->words,
        'description' => $faker->text(),
        'release_date' => $faker->dateTime(),
        'rating' => $faker->randomElement(['1', '2', '3', '4', 5])[0],
        'ticket_price' => $faker->randomElement(['2500', '3000', '4000'])[0],
        'country' => $faker->country,
        'genre' => $faker->randomElement(['action', 'romance', 'comedy', 'classical']),
        'photo' => $photoFileName
    ];
});
