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
];

return $regulator;
