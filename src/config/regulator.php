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
    'user_model' => 'App\Model'
];

return $regulator;
