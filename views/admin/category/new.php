<?php

use App\Connection;
use App\Table\CategoryTable;
use App\HTML\Form;
use App\Validators\CategoryValidators;
use App\ObjectHelper;
use App\Model\Category;
use App\Auth;

Auth::check();

$errors = [];
$item = new Category();

if(!empty($_POST)){
    $pdo = Connection::getPDO();
    $table = new CategoryTable($pdo);
    $v = new CategoryValidators($_POST, $table);
    ObjectHelper::hydrate($item, $_POST, ['name', 'slug'] );
    if($v->validate()){
        $table->create([
            'name' => $item->getName(),
            'slug' => $item->getSlug()
        ]);
        header('Location:' . $router->url('admin_categories', ['id' => $item->getID()], '?created=1'));
        exit();
    }else{
        $errors = $v->errors();
    }
}

$form = new Form($item, $errors);

?>
<main>
    <?php if(!empty($errors)): ?>
        <div class="alert alert-danger">
            La catégorie n'a pas pu être enregistré, merci de corriger vos erreurs
        </div>
    <?php endif ?>
    <section class="padding-10 layout">
        <h1>Créer une catégorie</h1>
        <?php require("_form.php"); ?>
    </section>
</main>