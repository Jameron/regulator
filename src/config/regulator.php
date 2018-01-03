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
        'resource_route' => 'users',
        'index' => [
            'card-header' => 'Users',
            'card-title' => '',
            'card-subtitle' => '',
            'search' => [
                'show' => true,
                'placeholder' => 'Search users',
                'button_text' => 'Locate',
                'icon' => 'search',
                'route' => '/users/search',
            ],
            'online_status_identifier' => '<span class="online"></span>',
            'offline_status_identifier' => '<span class="offline"></span>'
        ],
    ],
    'role' => [
        'resource_route' => 'roles',
        'index' => [
            'card-header' => 'Roles',
            'card-title' => '',
            'card-subtitle' => '',
        ],
    ],
    'permission' => [
        'resource_route' => 'permissions',
        'index' => [
            'card-header' => 'Permissions',
            'card-title' => '',
            'card-subtitle' => '',
        ],
    ]
];

return $regulator;
