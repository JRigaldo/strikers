<?php $title="L'agenda des manifestions";

use \App\Model\Post;

$pdo = new PDO('mysql:dbname=strikerblog;host=127.0.0.1', 'root', 'root', [
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$currentPage = (int)($_GET['page'] ?? 1) ?: 1;
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
            <article class="article">
                <div class="article__category">
                    <span>egypte</span><span>caire</span>
                </div>
                <a href="<?= $router->url('post', ['id'=> $post->getID(), 'slug'=> $post->getSlug()]) ?>">
                    <div class="article__image">
                        <img src="images/pictures/image-1.jpg" alt="">
                    </div>
                    <h1 class="article__title"><span class="title-date"><?= $post->getDateTime()->format('d.m.Y') ?></span>Sur la place Tarir</h1>
                    <div class="article__content padding-5">
                        <h2><?= htmlentities($post->getName()) ?></h2>
                        <p><?= $post->getExcerpt(); ?></p>
                    </div>
                </a>
                <div class="article__footer flex-center space-between">
                    <button><a href="#" class="article__footer--link">https://xrlausanne.ch</a></button>
                    <button><a href="#" class="article__footer--btn">Participer</a></button>
                    <button><a href="#" class="article__footer--btn--icon"><img src="images/icons/share-icon.svg"
                                                                                alt=""></a></button>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </section>
</main>