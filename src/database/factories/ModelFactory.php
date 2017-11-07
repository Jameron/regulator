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

$factory->defineAs(App\User::class, 'admin', function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName . ' ' . $faker->lastName,
        'email' => 'admin@example.com',
        'password' => bcrypt('qwe123'),
        'remember_token' => str_random(10),
    ];
});

$factory->defineAs(App\User::class, 'user', function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName . ' ' . $faker->lastName,
        'email' => 'user@example.com',
        'password' => bcrypt('qwe123'),
        'remember_token' => str_random(10),
    ];
});

$factory->defineAs(Jameron\Regulator\Models\Role::class, 'admin', function (Faker\Generator $faker) {
    return [
        'slug' => 'admin',
        'level' => '90',
        'name' => 'Admin',
    ];
});

$factory->defineAs(Jameron\Regulator\Models\Role::class, 'user', function (Faker\Generator $faker) {
    return [
        'slug' => 'user',
        'level' => '70',
        'name' => 'User',
    ];
});


$factory->defineAs(Jameron\Regulator\Models\Permission::class, 'view_user_dashboard',function (Faker\Generator $faker) {
    return [
        'slug' => 'view_user_dashboard',
        'name' => 'View User Dashboard',
    ];
});

$factory->defineAs(Jameron\Regulator\Models\Permission::class, 'view_admin_dashboard',function (Faker\Generator $faker) {
    return [
        'slug' => 'view_admin_dashboard',
        'name' => 'View Admin Dashboard',
    ];
});

$factory->defineAs(Jameron\Regulator\Models\Permission::class, 'manage_users',function (Faker\Generator $faker) {
    return [
        'slug' => 'manage_users',
        'name' => 'Manage Users',
    ];
});

$factory->defineAs(Jameron\Regulator\Models\Permission::class, 'view_system_wide_reports',function (Faker\Generator $faker) {
    return [
        'slug' => 'view_system_wide_reports',
        'name' => 'View System Wide Reports',
    ];
});

$factory->defineAs(Jameron\Regulator\Models\Permission::class, 'manage_roles_permissions',function (Faker\Generator $faker) {
    return [
        'slug' => 'manage_roles_permissions',
        'name' => 'Manage Roles and Permissions',
    ];
});


$factory->defineAs(Jameron\Regulator\Models\Permission::class, 'edit_account_info',function (Faker\Generator $faker) {
    return [
        'slug' => 'edit_account_info',
		'name' => 'Edit Account Info',
    ];
});
