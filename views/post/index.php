<?php $title="L'agenda des manifestions";

use \App\Model\Post;
use \App\Connection;
use \App\PaginatedQuery;

$pdo = Connection::getPDO();

$paginatedQuery = new PaginatedQuery(
    "SELECT * FROM post ORDER BY created_at",
    "SELECT COUNT(id) from post"
);

$posts = $paginatedQuery->getItems(Post::class);
$link = $router->url('blog');

?>
<main>
    <section class="section__banner section__banner-main padding-10">
        <a href="#"><h4 class="section__date">Juillet</h4></a>
        <div class="row">
            <?php foreach ($posts as $post): ?>
                <?php require 'card.php' ?>
            <?php endforeach; ?>
        </div>
    </section>
    <div class="btn-pages--container">
        <?= $paginatedQuery->previousLink($link); ?>
        <?= $paginatedQuery->nextLink($link); ?>
    </div>
</main>