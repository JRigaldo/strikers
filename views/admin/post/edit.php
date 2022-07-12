<?php

use App\Connection;
use App\Table\PostTable;
use App\Validator;
use App\HTML\Form;

$pdo = Connection::getPDO();

$postTable = new PostTable($pdo);
$post = $postTable->find($params['id']);
$success = false;
$errors = [];

if(!empty($_POST)){
    Validator::lang('fr');
    $v = new Validator($_POST);
    $v->rule('required', ['name', 'slug']);
    $v->rule('lengthBetween', ['name', 'slug'], 3, 200);
    $post
        ->setName($_POST['name'])
        ->setContent($_POST['content'])
        ->setSlug($_POST['slug'])
        ->setCreatedAt($_POST['created_at']);
    if($v->validate()){
        $postTable->update($post);
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
    <?php if(!empty($errors)): ?>
        <div class="alert alert-danger">
            L'article n'a pas pu être modifier, merci de corriger vos erreurs
        </div>
    <?php endif ?>
    <section class="padding-10 layout">
        <h1>Editer l'article <?= $params['id'] ?></h1>
        <form action="" method="POST" class="form__container" style="margin-bottom: 50px; max-width:100%;">
            <?= $form->input('name', 'Titre') ?>
            <?= $form->input('slug', 'URL') ?>
            <?= $form->textarea('content', 'Contenu') ?>
            <?= $form->input('created_at', 'Date de création') ?>
            <button class="flex-center" style="margin-top: 40px;" type="submit"><div class="btn-primary">Editer</div></button>
        </form>
    </section>
</main>