<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Fabric;
use Faker\Generator as Faker;

$factory->define(Fabric::class, function (Faker $faker) {
    return [
        'name' => $this->faker->words(3, true),
        'description' => $this->faker->paragraphs(3, true)
    ];
});
