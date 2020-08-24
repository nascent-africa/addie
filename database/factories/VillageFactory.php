<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Village;
use Faker\Generator as Faker;

$factory->define(Village::class, function (Faker $faker) {
    return [
        'name'          => $faker->country,
        'longitude'     => $faker->longitude,
        'latitude'      => $faker->latitude,
        'country_id'    => \App\Country::inRandomOrder()->first()->id,
        'region_id'     => \App\Region::inRandomOrder()->first()->id,
        'province_id'       => \App\Province::inRandomOrder()->first()->id,
        'city_id'       => \App\City::inRandomOrder()->first()->id
    ];
});
