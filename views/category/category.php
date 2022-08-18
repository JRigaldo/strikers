<?php

use App\Connection;
use App\Model\{Category, Post};
use App\PaginatedQuery;
use App\Table\PostTable;
use App\Table\CategoryTable;


$id = (int)$params['id'];
$slug = $params['slug'];

$pdo = Connection::getPDO();
$category = (new CategoryTable($pdo))->find($id);

if($category->getSlug() !== $slug){
    $url = $router->url('category', [$slug => $category->getSlug(), 'id' => $id]);
    http_response_code(301);
    header('Location: ' . $url);
}
$title = "Catégorie {$category->getName()}";

[$posts, $pagination] = (new PostTable($pdo))->findPaginatedForCategory($category->getID());

$link = $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]);

?>
<main>
    <h1><?= e($title) ?></h1>
    <section class="padding-10">
        <div class="section__banner">
            <div class="section__banner-main"></div>
        </div>
        <div class="container--top">
            <div class="row">
                <?php foreach ($posts as $post): ?>
                    <?php require dirname(__DIR__) . '/post/card.php' ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <div class="btn-pages--container">
        <?= $pagination->previousLink($link) ?>
        <?= $pagination->nextLink($link) ?>
    </div>
</main>

