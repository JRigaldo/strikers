<?php

use App\Connection;
use App\Table\CategoryTable;
use App\Auth;

$title = "Gestion des catégories";

Auth::check();
$pdo = Connection::getPDO();
$items = (new CategoryTable($pdo))->all();

$link = $router->url('admin_categories');

?>
<main>
    <?php if(isset($_GET['delete'])): ?>
        <div class="alert alert-succes">
            L'enregistrement à bien été supprimé
        </div>
    <?php endif; ?>
    <section class="padding-top-30 layout">
        <h1>Agendez les grèves à venir</h1>
        <button class="flex-center" style="margin-top: 40px;"><a href="<?= $router->url('admin_category_new') ?>" class="btn-primary">Nouveau</a></button>
        <ul class="tab">
            <?php foreach ($items as $item): ?>
                <li>
                    <span>#<?= $item->getID() ?></span>
                    <article>
                        <div><a href="<?= $router->url('admin_category', ['id'=> $item->getID()]) ?>"><?= e($item->getName()) ?></a></div>
                        <div><?= $item->getSlug() ?></div>
                        <div><button><a href="<?= $router->url('admin_category', ['id' => $item->getID()]) ?>"><img src="/images/icons/edite-icon.svg" alt=""></a></button></div>
                        <div><form action="<?= $router->url('admin_category_delete', ['id' => $item->getID()]) ?>" method="POST" onsubmit="return confirm('Voulez-vous supprimer ?')"><button type="submit"><img src="/images/icons/trash-icon.svg" alt=""></button></form></div>
                    </article>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
</main>