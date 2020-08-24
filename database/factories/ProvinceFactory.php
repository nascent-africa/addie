<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Province;
use Faker\Generator as Faker;

$factory->define(Province::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->country,
        'longitude' => $faker->longitude,
        'latitude' => $faker->latitude,
        'country_id' => \App\Country::inRandomOrder()->first()->id,
        'region_id' => \App\Region::inRandomOrder()->first()->id
    ];
});
