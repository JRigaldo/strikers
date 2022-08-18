<?php $title="L'agenda des manifestions";

use App\Connection;
use App\Model\Post;
use App\PaginatedQuery;
use App\Table\PostTable;
use App\Model\Category;

$pdo = Connection::getPDO();
[$posts, $pagination] = (new PostTable($pdo))->findPaginated();

$link = $router->url('blog');

?>
<main>
    <section class="padding-10">
        <div class="section__banner">
            <div class="section__banner-main"></div>
        </div>
        <div class="container--top">
            <div class="row">
                <?php foreach ($posts as $post): ?>
                    <?php require 'card.php' ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <div class="btn-pages--container">
        <?= $pagination->previousLink($link); ?>
        <?= $pagination->nextLink($link); ?>
    </div>
</main>