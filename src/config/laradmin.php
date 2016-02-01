<?php

return [
    'projectname' => 'Cinema K-Fé',

    'prefix' => 'beheer',

    'side_menu' => [
        'Test' => [
            'type' => 'submenu',
            'icon' => 'users',
            'roles' => ['admin', 'author'],
            'submenu' => [
                'subtest' => [
                    'url' => 'test',
                    'icon' => 'circle-o'
                ]
            ]
        ]
    ],

    'color' => 'blue',

    'can_register' => true,

    'register_user_role' => 'user',

    'company_name' => 'Matthieu Calie',

    'company_url'  => 'http://calie.be'
];
