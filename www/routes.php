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

    '/uservalidprofile' => [
    'controller' => 'User',
    'action' => 'userValidProfile'
    ],

    '/userprofile' => [
    'controller' => 'User',
    'action' => 'userProfile'
    ],

    '/userinterface' => [
    'controller' => 'User',
    'action' => 'userInterface'
    ],

    '/login' => [
        'controller' => 'User',
        'action' => 'showLoginForm'
    ],

    '/contact' => [
    'controller' => 'User',
    'action' => 'contact'
    ],

    '/usermodifyprofile' => [
        'controller' => 'User',
        'action' => 'userModifyProfile'
    ],
];
