<?php
return [
    'guest' => [
        'type' => 1,
        'children' => [
            'login',
            'sign-up',
            'error',
            'index',
        ],
    ],
    'reader' => [
        'type' => 1,
        'children' => [
            'logout',
            'index',
            'view',
            'profile',
        ],
    ],
    'manager' => [
        'type' => 1,
        'children' => [
            'logout',
            'delete',
            'update',
            'view',
        ],
    ],
    'admin' => [
        'type' => 1,
    ],
    'login' => [
        'type' => 2,
    ],
    'logout' => [
        'type' => 2,
    ],
    'error' => [
        'type' => 2,
    ],
    'sign-up' => [
        'type' => 2,
    ],
    'index' => [
        'type' => 2,
    ],
    'view' => [
        'type' => 2,
    ],
    'update' => [
        'type' => 2,
    ],
    'delete' => [
        'type' => 2,
    ],
    'profile' => [
        'type' => 2,
    ],
];
