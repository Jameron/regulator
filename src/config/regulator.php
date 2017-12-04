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
    'user_model_class' => App\User::class,
    'display' => [
        'card-header' => 'Users',
        'card-title' => '',
        'card-subtitle' => '',
        'search' => [
            'show' => true,
            'placeholder' => 'Search systems',
            'button_text' => 'Search',
			'icon' => 'search',
			'route' => 'systems/search'
        ];
    ]
];

return $regulator;
