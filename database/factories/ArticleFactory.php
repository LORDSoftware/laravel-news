<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Article;
use Faker\Factory;
use Faker\Generator as Faker;
use Carbon\Carbon;

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

$factory->define(Article::class, function (Faker $faker) {
  
    $title = $faker->sentence;
    $slug = str_slug($title, '-');
    
    $carbon = Carbon::today();
    $carbon->subDays(rand(0, 10));
    
    return [
        'created_at' => $carbon,
        'title' => $title,
        'slug' => $slug,
        'category_id' => 0,
        'description' => $faker->paragraph,
        'content' => $faker->paragraphs(5, true),
        'active' => true
    ];
});
