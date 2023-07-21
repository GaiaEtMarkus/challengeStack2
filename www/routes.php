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

    '/userinterface' => [
        'controller' => 'User',
        'action' => 'userInterface'
    ],

    '/login' => [
        'controller' => 'User',
        'action' => 'showLoginForm'
    ],

    '/deconnexion' => [
        'controller' => 'User',
        'action' => 'deconnexion'
    ],

    '/contact' => [
        'controller' => 'User',
        'action' => 'contact'
    ],

    '/usermodifyprofile' => [
        'controller' => 'User',
        'action' => 'userModifyProfile'
    ],

    '/userdeleteprofile' => [
        'controller' => 'User',
        'action' => 'userDeleteProfile'
    ],

    '/createproduct' => [
        'controller' => 'Product',
        'action' => 'createProduct'
    ],

    '/deleteproduct' => [
        'controller' => 'Product',
        'action' => 'deleteProduct'
    ],

    '/modifyproduct' => [
        'controller' => 'Product',
        'action' => 'modifyProduct'
    ],

    '/validuser' => [
        'controller' => 'Moderator',
        'action' => 'validuser'
    ],

    '/validproduct' => [
        'controller' => 'Moderator',
        'action' => 'validproduct'
    ],

    '/displayproducts' => [
        'controller' => 'Product',
        'action' => 'displayproducts'
    ],

    '/displaydetailsproduct' => [
        'controller' => 'Product',
        'action' => 'displayProductDetails'
    ],

    '/createtransaction' => [
        'controller' => 'Transaction',
        'action' => 'createTransaction'
    ],

    '/savetransaction' => [
        'controller' => 'Transaction',
        'action' => 'saveTransaction'
    ],

    '/validatetransaction' => [
        'controller' => 'Transaction',
        'action' => 'validateTransaction'
    ],

    '/forgotpassword' => [
        'controller' => 'User',
        'action' => 'forgotPassword'
    ],

    '/changepassword' => [
        'controller' => 'User',
        'action' => 'changePassword'
    ],

    '/moderatorinterface' => [
        'controller' => 'Moderator',
        'action' => 'moderatorInterface'
    ],

    '/admininterface' => [
        'controller' => 'Admin',
        'action' => 'adminInterface'
    ],

    '/createcomment' => [
        'controller' => 'Comment',
        'action' => 'createComment'
    ],

    '/displayuserstats' => [
        'controller' => 'User',
        'action' => 'displayUserStats'
    ],

    '/deletecomment' => [
        'controller' => 'Comment',
        'action' => 'deleteComment'
    ],

    '/refuseuser' => [
        'controller' => 'Moderator',
        'action' => 'refuseUser'
    ],

    '/banuser' => [
        'controller' => 'Moderator',
        'action' => 'banUser'
    ],

    '/validdatasite' => [
        'controller' => 'Admin',
        'action' => 'validDataSite'
    ],

    '/configsite' => [
        'controller' => 'Admin',
        'action' => 'configSite'
    ],

    '/moderatorcreateprofile' => [
        'controller' => 'Admin',
        'action' => 'moderatorCreateProfile'
    ],

    '/refuseproduct' => [
        'controller' => 'Moderator',
        'action' => 'refuseProduct'
    ],

    '/admincreateprofile' => [
        'controller' => 'Admin',
        'action' => 'adminCreateProfile'
    ],
];


