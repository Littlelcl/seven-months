<?php

use Faker\Generator as Faker;

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'nickname' => 'xixixi',
        'phone' => '15700082993',
        'password' => bcrypt('test'), // secret
        'remember_token' => str_random(10),
    ];
});

$factory->state(App\Models\User::class, 'delinquent', [
    'phone' => '15700083287',
]);

$factory->state(App\Models\User::class, 'address', function ($faker) {
    return [
        'nickname' => 'zheli',
    ];
});
