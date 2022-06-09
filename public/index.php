<?php

require '../vendor/autoload.php';

define('DEBUG_TIME', microtime(true));

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();


$router = new App\Router(dirname(__DIR__) . '/views');

$router
    ->get('/blog', 'post/index', 'blog')
    ->get('/blog/category', 'category/show', 'category')
    ->get('/sign-in', 'layouts/sign-in', 'sign-in')
    ->get('/log-in', 'layouts/log-in', 'log-in')
    ->get('/dashboard', 'layouts/dashboard', 'dashboard')
    ->get('/dashboard-post', 'layouts/dashboard-post', 'dashboard-post')
    ->get('/tab-category', 'category/tab-category', 'tab-category')
    ->get('/tab-post', 'post/tab-post', 'tab-post')
    ->get('/edite', 'post/edite', 'edite')
    ->get('/post', 'post/post', 'post')
    ->run();
