<?php

require '../vendor/autoload.php';

$router = new App\Router(dirname(__DIR__) . '/views');

$router
    ->get('/blog', 'post/index', 'blog')
    ->get('/blog/category', 'category/show', 'category')
    ->get('/sign-in', 'layouts/sign-in', 'sign-in')
    ->run();
