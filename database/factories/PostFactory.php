<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->realText();
    return [
        'title' => $title,
        'content' => $faker->text,
        'slug' => Str::slug($title, '-'),
        'active' => $faker->boolean(),
    ];
});
