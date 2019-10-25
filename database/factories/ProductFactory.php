<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $this->faker->words(3, true),
        'description' => $this->faker->paragraphs(3, true),
        'price' => $this->faker->randomFloat(2, 1000, 5000)
    ];
});
