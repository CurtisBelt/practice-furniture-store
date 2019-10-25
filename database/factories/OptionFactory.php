<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Option;
use Faker\Generator as Faker;
use App\Fabric;
use App\Leg;

$factory->define(Option::class, function (Faker $faker) {
    $optionables = [Fabric::class, Leg::class];
    $optionableType = $faker->randomElement($optionables);
    $optionable = factory($optionableType)->create();

    return [
        'product_id' => App\Product::all()->random()->id,
        'optionable_type' => $optionableType,
        'optionable_id' => $optionable->id
    ];
});
