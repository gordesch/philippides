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
$factory->define(App\Person::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'address' => $faker->streetAddress,
        'zipcode' => $faker->postcode,
        'city' => $faker->city,
        'mobile_phone' => $faker->e164PhoneNumber,
        'landline' => $faker->e164PhoneNumber,
        'mobile_phone_status' => $faker->randomElement([
            'unknown',
            'valid',
            'not_valid',
        ]),
        'university' => $faker->word,
        'major' => $faker->randomElement([
            'Histoire',
            'Sciences Po',
            'Géographie',
            'Psychologie',
            'Droit',
            'Philosophie/Sociologie',
        ]),
        'email' => $faker->email,
        'messageable' => $faker->boolean(95),
        'comments' => $faker->text,
        'section_id' => $faker->numberBetween(1, 12),
        'virtual_number_id' => 1,
    ];
});
