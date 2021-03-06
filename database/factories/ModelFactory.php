<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'username' => $faker->unique()->username,
        'email' => $faker->unique()->safeEmail,
        'first_name' => $faker->firstname(),
        'last_name' => $faker->lastname,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

// Properties
$factory->define(App\Models\Property::class, function (Faker\Generator $faker) {
    $max_adults = $faker->numberBetween(1, 5);

    return [
        'title' => $faker->words( rand(1, 3), true ),
        'description' => $faker->paragraph(6),
        'country_id' => Country::inRandomOrder()->first()->id,
        'rules' => $faker->paragraph(),
        'cancellation' => $faker->paragraph(),
        'max_adults' => $max_adults,
        'max_kids' => $max_adults - 2,
        'bedrooms' => $faker->numberBetween(1, 3),
        'price' => $faker->randomFloat(false, 10, 5000),
        'beds' => $faker->numberBetween(1, 3),
        'baths' => $faker->numberBetween(1, 3),
        'address' => $faker->address(),
        'type' => $faker->numberBetween(1,2),
        'phone' => $faker->phoneNumber
    ];

});
