<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'price' => $faker->numberBetween(1000, 7800),
        'brand_id' => $faker->randomElement(\App\Models\Brand::pluck('id')),
        'category_id' => $faker->randomElement(\App\Models\Category::pluck('id')),
    ];
});
