<?php

use App\Comment;
use App\Movie;
use Illuminate\Database\Seeder;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Movie::class, 3)->create()
        ->each(function ($movie) {
            $movie->comments()->save(factory(Comment::class)->make()); 
        });
    }
}
