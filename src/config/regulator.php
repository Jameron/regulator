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
    'user_model' => 'App\User',
    'user_model_class' => App\User::class
];

return $regulator;
