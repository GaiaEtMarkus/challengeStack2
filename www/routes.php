<?php

return [
    '/' => [
        'controller' => 'Main',
        'action' => 'index'
    ],

    '/usercreateprofile' => [
        'controller' => 'User',
        'action' => 'userCreateProfile'
    ],

    '/userprofile' => [
    'controller' => 'User',
    'action' => 'userProfile'
    ],

    '/userinterface' => [
    'controller' => 'User',
    'action' => 'userInterface'
    ],

    '/contact' => [
        'controller' => 'User',
        'action' => 'contact'
        ],
];
