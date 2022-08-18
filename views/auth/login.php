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
    $errors['password'] = 'Identifiant ou mot de passe incorrect';
    if(!empty($_POST['username']) && !empty($_POST['password'])){
        $table = new UserTable(Connection::getPDO());
        try{
            $u = $table->findUserByUsername($_POST['username']);
            if(password_verify($_POST['password'], $u->getPassword()) === true){
                session_start();
                $_SESSION['auth'] = $u->getUserID();
                header('Location:' . $router->url('admin_posts'));
                exit();
            }
        }catch(\Exception $e){
            throw new \Exception("Cette page n'existe pas");
        }
    }
}


$form = new Form($user, $errors);

?>
<main>
    <?php if(isset($_GET['forbidden'])): ?>
        <div class="alert alert-danger">
            Vous ne pouvez pas accéder à cette page
        </div>
    <?php endif; ?>
    <section class="padding-10 layout">
        <div class="section__banner">
            <div class="section__banner-login"></div>
        </div>
        <div class="container--top">
            <img class="avatar" src="images/icons/user-icon.svg" alt="">
            <form action="<?= $router->url('login') ?>" method="POST" class="form__container" style="margin-bottom: 50px;">
                <?= $form->input('username', 'Nom d\'utilisateur') ?>
                <?= $form->input('password', 'Mot de passe') ?>
                <button class="flex-center" style="margin-top: 40px;" type="submit"><div class="btn-primary">Se connecter</div></button>
            </form>
        </div>
    </section>
</main>