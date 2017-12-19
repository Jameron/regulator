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
            'online_status_identifier' => '<span class="online" style="background: #0c0;width: 20px;height: 20px;border-radius: 50%;"></span>',
            'offline_status_identifier' => '<span class="offline" style="background: #f00;width: 20px;height: 20px;border-radius: 50%;"></span>'
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
