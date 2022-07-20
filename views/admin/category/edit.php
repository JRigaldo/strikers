<?php

use App\Connection;
use App\Table\CategoryTable;
use App\HTML\Form;
use App\Validators\CategoryValidators;
use App\ObjectHelper;
use App\Auth;

Auth::check();

$pdo = Connection::getPDO();
$table = new CategoryTable($pdo);
$item = $table->find($params['id']);
$fields = ['name', 'slug'];
$success = false;
$errors = [];

if(!empty($_POST)){
    $v = new CategoryValidators($_POST, $table, $item->getID());
    ObjectHelper::hydrate($item, $_POST, $fields);
    if($v->validate()){
        $table->update([
                'name' => $item->getName(),
                'slug' => $item->getSlug()
        ], $item->getID());
        $success = true;
    }else{
        $errors = $v->errors();
    }
}

$form = new Form($item, $errors);

?>
<main>
    <?php if($success): ?>
        <div class="alert alert-succes">
            La catégorie à bien été modifié !
        </div>
    <?php endif; ?>
    <?php if(isset($_GET['created'])): ?>
        <div class="alert alert-succes">
            La catégorie à bien été créé
        </div>
    <?php endif; ?>
    <?php if(!empty($errors)): ?>
        <div class="alert alert-danger">
            La catégorie n'a pas pu être modifier, merci de corriger vos erreurs
        </div>
    <?php endif ?>
    <section class="padding-10 layout">
        <h1>Editer la catégorie <?= $params['id'] ?></h1>
        <?php require("_form.php"); ?>
    </section>
</main>