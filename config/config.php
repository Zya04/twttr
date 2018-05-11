<?php

$config = [
    'homepage_route' => 'hall',
    'db' => [
        'name'     => 'twttr',
        'user'     => 'root',
        'password' => '',
        'host'     => '127.0.0.1',
        'port'     => 3306
    ],
    'routes' => [
        'hall'    => 'Main:hall',
        'register' => 'Main:register',
        'login' => 'Main:login',
        'logout' => 'Main:logout',
        'profile' => 'Main:profile',
        'home' => 'Home:page',
        'message' => 'Home:message'
    ]
];
