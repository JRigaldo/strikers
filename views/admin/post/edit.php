<?php

use App\Connection;
use App\Table\PostTable;
use App\Table\CategoryTable;
use App\HTML\Form;
use App\Validators\PostValidators;
use App\ObjectHelper;
use App\Auth;

Auth::check();

$pdo = Connection::getPDO();

$postTable = new PostTable($pdo);
$categoryTable = new CategoryTable($pdo);
$categories = $categoryTable->list();
$post = $postTable->find($params['id']);
$categoryTable->hydratePost([$post]);
$success = false;
$errors = [];

if(!empty($_POST)){
    $v = new PostValidators($_POST, $postTable, $post->getID(), $categories);
    ObjectHelper::hydrate($post, $_POST, ['name', 'content', 'slug', 'created_at'] );
    if($v->validate()){
        $pdo->beginTransaction();
        $postTable->updatePost($post);
        $postTable->attachedCategories($post->getID(), $_POST['categories_ids']);
        $pdo->commit();
        $categoryTable->hydratePost([$post]);
        $success = true;
    }else{
        $errors = $v->errors();
    }
}

$form = new Form($post, $errors);

?>
<main>
    <?php if($success): ?>
        <div class="alert alert-succes">
            L'enregistrement à bien été modifié !
        </div>
    <?php endif; ?>
    <?php if(isset($_GET['created'])): ?>
        <div class="alert alert-succes">
            L'article à bien été créé
        </div>
    <?php endif; ?>
    <?php if(!empty($errors)): ?>
        <div class="alert alert-danger">
            L'article n'a pas pu être modifier, merci de corriger vos erreurs
        </div>
    <?php endif ?>
    <section class="padding-10 layout">
        <h1>Editer l'article <?= $params['id'] ?></h1>
        <?php require("_form.php"); ?>
    </section>
</main>