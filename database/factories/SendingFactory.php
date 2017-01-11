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
$factory->define(App\Sending::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->word,
        'body' => $faker->paragraph(3),
        'sent' => $faker->boolean(90),
        'type' => $faker->randomElement(['outgoing', 'incoming']),
        'section_id' => $faker->numberBetween(1, 12),
    ];
});
