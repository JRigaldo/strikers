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
    ->get('/blog/category/[*:slug]-[i:id]', 'category/category', 'category')
    ->get('/post/[*:slug]-[i:id]', 'post/post', 'post')
    ->get('/admin', 'admin/post/index', 'admin_posts')
    ->match('/admin/post/[i:id]', 'admin/post/edit', 'admin_post')
    ->post('/admin/post/[i:id]/delete', 'admin/post/delete', 'admin_post_delete')
    ->match('/admin/post/new', 'admin/post/new', 'admin_post_new')
    //->get('/admin/tab-category', 'admin/tab-category', 'tab-category')
    //->get('/sign-in', 'admin/sign-in', 'sign-in')
    //->get('/log-in', 'admin/log-in', 'log-in')
    //->get('/admin', 'admin/dashboard', 'dashboard')
    ->run();
