<?php

use App\Connection;
use App\Table\PostTable;
use App\Table\CategoryTable;
use App\HTML\Form;
use App\Validators\PostValidators;
use App\ObjectHelper;
use App\Model\Post;
use App\Auth;

Auth::check();
$pdo = Connection::getPDO();

$errors = [];
$post = new Post();
$post->setCreatedAt(date('Y-m-d H:i:s'));
$categoryTable = new CategoryTable($pdo);
$categories = $categoryTable->list();

if(!empty($_POST)){
    $postTable = new PostTable($pdo);
    $v = new PostValidators($_POST, $postTable, $post->getID(), $categories);
    ObjectHelper::hydrate($post, $_POST, ['name', 'content', 'slug', 'created_at'] );
    if($v->validate()){
        $pdo->beginTransaction();
        $postTable->createPost($post);
        $postTable->attachedCategories($post->getID(), $_POST['categories_ids']);
        $pdo->commit();
        header('Location:' . $router->url('admin_posts', ['id' => $post->getID()], '?created=1'));
        exit();
    }else{
        $errors = $v->errors();
    }
}

$form = new Form($post, $errors);

?>
<main>
    <?php if(!empty($errors)): ?>
        <div class="alert alert-danger">
            L'article n'a pas pu être enregistré, merci de corriger vos erreurs
        </div>
    <?php endif ?>
    <section class="padding-10 layout">
        <h1>Créer un article</h1>
        <?php require("_form.php"); ?>
    </section>
</main>