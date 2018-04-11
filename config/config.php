<?php

$config = [
    'homepage_route' => 'home',
    'db' => [
        'name'     => 'rekooc',
        'user'     => 'root',
        'password' => '',
        'host'     => '127.0.0.1',
        'port'     => 3306
    ],
    'routes' => [
        'home'    => 'Main:home',
        'register' => 'Main:register',
        'login' => 'Main:login',
        'logout' => 'Main:logout',
        'profile' => 'Main:profile'
    ]
];
