<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Region;
use Faker\Generator as Faker;

$factory->define(Region::class, function (Faker $faker) {
    return [
        'name'          => ['en' => $faker->state, 'fr' => $faker->state],
        'longitude'     => $faker->longitude,
        'latitude'      => $faker->latitude,
        'country_id'    => \App\Country::inRandomOrder()->first()->id
    ];
});
