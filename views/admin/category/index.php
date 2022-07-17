<?php

use App\Connection;
use App\Table\PostTable;
use App\Auth;

$title = "Adminisatration";

Auth::check();
$pdo = Connection::getPDO();
[$posts, $pagination] = (new PostTable($pdo))->findPaginated();

$link = $router->url('admin_posts');

?>
<main>
    <?php if(isset($_GET['delete'])): ?>
        <div class="alert alert-succes">
            L'enregistrement à bien été supprimé
        </div>
    <?php endif; ?>
    <section class="padding-top-30 layout">
        <h1>Agendez les grèves à venir</h1>
        <button class="flex-center" style="margin-top: 40px;"><a href="<?= $router->url('admin_post_new') ?>" class="btn-primary">Nouveau</a></button>
        <ul class="tab">
            <?php foreach ($posts as $post): ?>
                <li>
                    <span>#<?= $post->getID() ?></span>
                    <article>
                        <div><a href="<?= $router->url('admin_posts', ['id'=> $post->getID(), 'slug'=> $post->getSlug()]) ?>"><?= e($post->getName()) ?></a></div>
                        <div><a href="#"></a></div>
                        <div><button><a href="<?= $router->url('admin_post', ['id' => $post->getID()]) ?>"><img src="/images/icons/edite-icon.svg" alt=""></a></button></div>
                        <div><form action="<?= $router->url('admin_post_delete', ['id' => $post->getID()]) ?>" method="POST" onsubmit="return confirm('Voulez-vous supprimer ?')"><button type="submit"><img src="/images/icons/trash-icon.svg" alt=""></button></form></div>
                    </article>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
    <div class="btn-pages--container">
        <?= $pagination->previousLink($link); ?>
        <?= $pagination->nextLink($link); ?>
    </div>
</main>