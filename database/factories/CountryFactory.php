<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Country;
use Faker\Generator as Faker;

$factory->define(Country::class, function (Faker $faker) {
    return [
        'name'          => ['en' => $faker->country, 'fr' => $faker->country],
        'longitude'     => $faker->longitude,
        'latitude'      => $faker->latitude,
        'iso_code'      => $faker->countryCode,
        'calling_code'  => '+001'
    ];
});
