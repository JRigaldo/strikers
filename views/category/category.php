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
    <section class="section__banner section__banner-main padding-10">
        <a href="#"><h4 class="section__date">Juillet</h4></a>
        <div class="row">
            <?php foreach ($posts as $post): ?>
                <?php require dirname(__DIR__) . '/post/card.php' ?>
            <?php endforeach; ?>
        </div>
    </section>
    <div class="btn-pages--container">
        <?= $pagination->previousLink($link) ?>
        <?= $pagination->nextLink($link) ?>
    </div>
</main>

