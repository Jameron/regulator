<?php

$regulator = [
    'db_table_prefix' => '',
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
                'route' => '/users/search'
            ],
            'online_status_identifier' => '<span class="online"></span>',
            'offline_status_identifier' => '<span class="offline"></span>'
        ],
        'create' => [
            'enabled' => true,
            'button' => [
                'text'  => 'Create User',
                'route' => '/users/create'
            ],
        ],
        'show'=>[
            'hide_attributes' => [
                'id',
                'password',
                'remember_token',
                'installer_company_id'
            ]
        ]
    ],
    'role' => [
        'resource_route' => 'roles',
        'index' => [
            'card-header' => 'Roles',
            'card-title' => '',
            'card-subtitle' => '',
            'search' => [
                'show' => true,
                'placeholder' => 'Search roles',
                'button_text' => 'Locate',
                'icon' => 'search',
                'route' => '/roles/search'
            ],
        ],
    ],
    'permission' => [
        'resource_route' => 'permissions',
        'index' => [
            'card-header' => 'Permissions',
            'card-title' => '',
            'card-subtitle' => '',
            'search' => [
                'show' => true,
                'placeholder' => 'Search permissions',
                'button_text' => 'Locate',
                'icon' => 'search',
                'route' => '/permissions/search'
            ],
        ],
    ]
];

$regulator['roles'] =
    [
        'admin' => [
            'loginRedirectURI' => 'dash',
            'roles_columns' => 
            [
                [
                    'column' => 'id',
                    'label' => 'ID',
                ],
                [
                    'column' => 'name',
                    'label' => 'Name'
                ],
                [
                    'column' => 'slug',
                    'label' => 'Slug'
                ]
            ],
            'permissions_columns' => 
            [
                [
                    'column' => 'id',
                    'label' => 'ID',
                ],
                [
                    'column' => 'name',
                    'label' => 'Name'
                ]
            ]
        ],
        'user' => [
            'loginRedirectURI' => 'dash',
        ]
    ];
return $regulator;
