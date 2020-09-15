<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use App\Category;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    $categories_ids = Category::all()->pluck('id')->toArray();
    $random_category = array_rand($categories_ids);
    $name = $faker->words($nb = 3, $asText = true);
    return [
        'name' => $name,
        'description' => $faker->text($maxNbChars = 100),
        'slug' => str_replace(' ', '-', mb_strtolower($name)),
        'image_link' => 'img/imagem.jpg',
        'video' => 'https://www.youtube.com/embed/tgbNymZ7vqY',
        'category_id' => $categories_ids[$random_category],
    ];
});
