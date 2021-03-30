<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'company_id' => $faker->randomDigitNotNull,
        'product_name' => $faker->word,
        'price' => $faker->randomDigitNotNull,
        'stock' => $faker->randomDigitNotNull,
        'comment' => $faker->sentence
    ];
});
