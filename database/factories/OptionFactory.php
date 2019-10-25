<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Option;
use Faker\Generator as Faker;

$factory->define(Option::class, function (Faker $faker) {
    $optionables = [
        App\Fabric::class
        // App\Legs::class
    ];
    $optionableType = $faker->randomElement($optionables);
    $optionable = factory($optionableType)->create();

    return [
        'product_id' => App\Product::all()->random()->id,
        'optionable_type' => $optionableType,
        'optionable_id' => $optionable->id
    ];
});
