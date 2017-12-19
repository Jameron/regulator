<?php

$regulator = [
    'db_table_prefix' => '',
    'roles' => [
        'admin' => [
            'loginRedirectURI' => 'dash',
        ],
        'user' => [
            'loginRedirectURI' => 'dash',
        ],
    ],

    'user' => [
        'model' => \App\Models\User::class,
    ],
    'display' => [
        'users' => [
            'card-header' => 'Users',
            'card-title' => '',
            'card-subtitle' => '',
            'search' => [
                'show' => true,
                'placeholder' => 'Search users',
                'button_text' => 'Locate',
                'icon' => 'search',
                'route' => '/admin/users/search'
            ],
        ],
        'permissions' => [
            'card-header' => 'Permissions',
            'card-title' => '',
            'card-subtitle' => '',
        ],
        'roles' => [
            'card-header' => 'Roles',
            'card-title' => '',
            'card-subtitle' => '',
        ]
    ]
];
return $regulator;
