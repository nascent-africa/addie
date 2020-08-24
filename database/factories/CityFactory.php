<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\City;
use Faker\Generator as Faker;

$factory->define(City::class, function (Faker $faker) {
    return [
        'name'          => $faker->country,
        'longitude'     => $faker->longitude,
        'latitude'      => $faker->latitude,
        'country_id'    => \App\Country::inRandomOrder()->first()->id,
        'region_id'     => \App\Region::inRandomOrder()->first()->id,
        'province_id'       => \App\Province::inRandomOrder()->first()->id
    ];
});
