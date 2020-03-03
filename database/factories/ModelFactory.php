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

// $factory->define(App\User::class, function ($faker) {
//     return [
//         'name' => $faker->name,
//         'email' => $faker->email,
//         'password' => str_random(10),
//         'remember_token' => str_random(10),
//     ];
// });

$factory->define(App\User::class, function ($faker) {
	   return [
        'username' => $faker->name,
        'firstName' => $faker->firstName,
        'lastName' => $faker->lastName,
        'email' => $faker->email,
        'password' => bcrypt('kakiku'),
        'avatar' => 'http://forums.au.reachout.com/t5/image/serverpage/image-id/940i550AF6B5B7A0DE25?v=mpbl-1',
        'confirmed' => true,
    ];
});


$factory->define(App\Article::class, function ($faker) {
		return [
        // 'userId' => $faker->numberBetween(1,2),
        // 'userId' => $faker->numberBetween(1,17),
        'userId' => $faker->numberBetween(3,17),
        'lessonId' => $faker->numberBetween(1,12),
        'title' => $faker->sentence,
        'description' => $faker->paragraph(77),
    ];
});
    
$factory->define(App\Discussion::class, function ($faker) {
        return [
        // 'userId' => $faker->numberBetween(1,2),
        // 'userId' => $faker->numberBetween(1,17),
        'userId' => $faker->numberBetween(3,17),
        'categoryId' => $faker->numberBetween(1,7),
        'title' => $faker->sentence,
        'description' => $faker->paragraph(7),
    ];
});

$factory->define(App\Comment::class, function ($faker) {
        return [
        // 'userId' => $faker->numberBetween(1,2),
        // 'userId' => $faker->numberBetween(1,17),
        'userId' => $faker->numberBetween(3,17),
        // 'lessonId' => $faker->numberBetween(1,12),
        // 'articleId' => $faker->numberBetween(1,100),
        'discussionId' => $faker->numberBetween(1,30),
        'content' => $faker->paragraph(12),
    ];
});

