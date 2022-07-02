<?php $title="L'agenda des manifestions";

use \App\Model\Post;
use \App\Connection;
use \App\URL;

$pdo = Connection::getPDO();


$currentPage = URL::getPositiveInt('page', 1);
if($currentPage <= 0){
    throw new Exception('Numéro de page invalide');
}
$count = (int)$pdo->query("SELECT COUNT(id) from post")->fetch(PDO::FETCH_NUM)[0];
$perPage = 12;
$pages = ceil($count / $perPage);
if($currentPage > $pages){
    throw new Exception("Cette page n'existe pas");
}
$offset = $perPage * ($currentPage -1);
$query = $pdo->query("SELECT * FROM post ORDER BY created_at DESC LIMIT $perPage OFFSET $offset");
$posts = $query->fetchAll(PDO::FETCH_CLASS, Post::class);


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
        <?php if($currentPage > 1): ?>
        <?php
            $link = $router->url('blog');
            if($currentPage > 2) $link . '?page=' . ($currentPage - 1);
        ?>
        <button class="btn-icon-primary"><a href="<?= $link ?>"><img src="/images/icons/arrow_back.svg" alt=""></a></button>
        <?php endif; ?>
        <?php if($currentPage < $pages): ?>
            <button class="btn-icon-primary"><a href="<?= $router->url('blog') ?>?page=<?= $currentPage + 1 ?>"><img src="/images/icons/arrow_forward.svg" alt=""></a></button>
        <?php endif; ?>
    </div>
</main>