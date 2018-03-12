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

// Listings
$factory->define(App\Models\Listing::class, function (Faker\Generator $faker) {
    $max_adults = $faker->numberBetween(1, 5);

    return [
        'title' => $faker->words( rand(1, 3), true ),
        'description' => $faker->paragraph(6),
        'rules' => $faker->paragraph(),
        'cancellation' => $faker->paragraph(),
        'max_adults' => $max_adults,
        'max_kids' => $max_adults - 2,
        'bedrooms' => $faker->numberBetween(1, 3),
        'price' => $faker->randomFloat(false, 10),
        'beds' => $faker->numberBetween(1, 3),
        'baths' => $faker->numberBetween(0, 3),
        'address' => $faker->address(),
        'type' => $faker->numberBetween(1,2),
        'phone' => $faker->phoneNumber
    ];

});

// Images
$factory->define(App\Models\ListingImage::class, function(Faker\Generator $faker) {

    return [
        'image' => $faker->image('600', '480', 'city') + rand(1,10),
        'description' => $faker->paragraph(2)
    ];

});