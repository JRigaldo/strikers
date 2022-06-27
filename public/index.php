<?php

require '../vendor/autoload.php';

define('DEBUG_TIME', microtime(true));

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

if(isset($_GET['page']) && $_GET['page'] === '1'){
    /*if($page === '1'){
        header('Location :' . $router->url('blog'));
        http_response_code(301);
        exit();
    }*/
    //$url = $_SERVER['REQUEST_URI'];
    //dd($url);
    $uri = explode('?', $_SERVER['REQUEST_URI'])[0];
    $get = $_GET;
    unset($get['page']);
    $query = http_build_query($get);
    if(!empty($query)){
        $uri = $uri . '?' . $query;
    }
    http_response_code(301);
    header('Location:' . $uri);
    exit();
}

$router = new App\Router(dirname(__DIR__) . '/views');

$router
    ->get('/', 'post/index', 'blog')
    ->get('/blog/category', 'category/show', 'category')
    ->get('/sign-in', 'layouts/sign-in', 'sign-in')
    ->get('/log-in', 'layouts/log-in', 'log-in')
    ->get('/dashboard', 'layouts/dashboard', 'dashboard')
    ->get('/dashboard-post', 'layouts/dashboard-post', 'dashboard-post')
    ->get('/tab-category', 'category/tab-category', 'tab-category')
    ->get('/tab-post', 'post/tab-post', 'tab-post')
    ->get('/edite', 'post/edite', 'edite')
    ->get('/post/[*:slug]-[i:id]', 'post/post', 'post')
    //->get('/post', 'post/post', 'post')
    ->run();
