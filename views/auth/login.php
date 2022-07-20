<?php

use App\Model\User;
use App\HTML\Form;
use App\Table\UserTable;
use App\Connection;

$title='Page de connexion';

$user = new User();
$errors = [];
if(!empty($_POST)){
    $user->setUsername($_POST['username']);
    if(empty($_POST['username']) || empty($_POST['password'])){
        $errors['password'] = 'Identifiant ou mot de passe incorrect';
    }
    $table = new UserTable(Connection::getPDO());
    try{
        $u = $table->findUserByUsername($_POST['username']);
        dd(password_verify($_POST['password'], $u->getPassword()));
    }catch(NotFoundException $e){
        $errors['password'] = 'Identifiant ou mot de passe incorrect';
    }
}


$form = new Form($user, $errors);

?>
<main>
    <section class="section__banner section__banner-login padding-10 layout">
        <img class="avatar" src="images/icons/user-icon.svg" alt="">
        <form action="" method="POST" class="form__container" style="margin-bottom: 50px;">
            <?= $form->input('username', 'Nom d\'utilisateur') ?>
            <?= $form->input('password', 'Mot de passe') ?>
            <button class="flex-center" style="margin-top: 40px;" type="submit"><div class="btn-primary">Se connecter</div></button>
        </form>
    </section>
</main>