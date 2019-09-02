<?php

/** @var Factory $factory */

use App\Models\Vehicle;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Vehicle::class, function (Faker $faker) {
    return [
        'license_Plate' => $faker->regexify('^[A-Z]{2}\s[0-9]{4}$'), // Creates Random license_Plate
        'make' => $faker->randomElement($array = array ('Acura','Audi','BMW','Suzuki','Toyota')), // Creates make
        'model' => $faker->regexify('^[A-Z]{2}\ s[0-9]{4}$'),
        'year'=>$faker->year($max = 'now')
    ];
});


