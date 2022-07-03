<?php

use \App\Connection;
use \App\Model\{Category, Post};
use \App\PaginatedQuery;

$id = (int)$params['id'];
$slug = $params['slug'];

$pdo = Connection::getPDO();
$query = $pdo->prepare('SELECT * FROM category WHERE id = :id');
$query->execute(['id' => $id]);
$query->setFetchMode(PDO::FETCH_CLASS, Category::class);
/** @var Category|false **/
$category = $query->fetch();

if($category === false){
    throw new \Exception("Aucune categorie ne correspond à cette ID");
}

if($category->getSlug() !== $slug){
    $url = $router->url('category', [$slug => $category->getSlug(), 'id' => $id]);
    http_response_code(301);
    header('Location: ' . $url);
}
$title = "Catégorie {$category->getName()}";

$paginatedQuery = new PaginatedQuery(
    "SELECT p.* FROM post p JOIN post_category pc ON pc.post_id = p.id WHERE pc.category_id = {$category->getID()} ORDER BY created_at",
    "SELECT COUNT(category_id) FROM post_category WHERE category_id = {$category->getID()}"
);

/* @var Post[] */
$posts = $paginatedQuery->getItems(Post::class);
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
        <?= $paginatedQuery->previousLink($link) ?>
        <?= $paginatedQuery->nextLink($link) ?>
    </div>
</main>

