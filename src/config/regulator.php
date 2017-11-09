<?php

$regulator = [
    'db_table_prefix' => '',
    'roles' => [
        'user' => [
            'loginRedirectURI' => 'home',
        ],
        'admin' => [
            'loginRedirectURI' => 'admin',
        ],
    ],
    'user_model' => 'App\Models\User',
    'user_model_class' => App\Models\User::class
];

return $regulator;
