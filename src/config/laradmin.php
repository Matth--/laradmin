<?php

return [
    /*
     * The projectname
     * Change this if you want it to change in your titles and in the
     * top left corner
     */
    'projectname' => 'Laradmin',

    /**
     * The prefix to all routes
     */
    'prefix' => 'admin',

    /**
     * Allow registration
     */
    'can_register' => false,

    /*
     * The menu items
     */
    'menu' => [
        'Welcome' => [
            'route' =>  'laradmin.welcome',
            'icon' => 'check'
        ]
    ],
];