<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'company_name' => $faker->company,
        'street_address' => $faker->streetAddress,
    ];
});
