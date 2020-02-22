<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Movie;
use App\Helpers\Utility;
use Illuminate\Http\File; 
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

    // $photo = $faker->image(null, 1000, 600, 'people'); Don't use this
     
    $photo =  Utility::generateImage(1000, 600);

    if ($photo === false) {
        dd('It seems the remote server is down. No image was generated.');
    }


    $photoFile = new File($photo);
    $photoFileName = md5(time()) . '.jpg';
    
    Storage::disk('public_dir')->putFileAs('images', $photoFile, $photoFileName);

    $title = ucfirst($faker->words[0]) . ' ' . ucfirst($faker->words[0]);

    $slug = Str::slug($title, '-');
    
    return [
        'title' => $title,
        'description' => $faker->text(200),
        'release_date' => $faker->dateTime(),
        'rating' => rand(2, 5),
        'ticket_price' => rand(2300, 4000),
        'country' => $faker->country,
        'genre' => $faker->randomElement(['action', 'romance', 'comedy', 'classical']),
        'photo' => $photoFileName, 
        'slug' => $slug
    ];
});
