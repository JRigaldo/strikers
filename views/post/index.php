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
    <section class="section__banner section__banner-main padding-10">
        <a href="#"><h4 class="section__date">Juillet</h4></a>
        <div class="row">
            <?php foreach ($posts as $post): ?>

                <?php require 'card.php' ?>
            <?php endforeach; ?>
        </div>
    </section>
    <div class="btn-pages--container">
        <?= $pagination->previousLink($link); ?>
        <?= $pagination->nextLink($link); ?>
    </div>
</main>