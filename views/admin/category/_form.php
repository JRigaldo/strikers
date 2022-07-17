<form action="" method="POST" class="form__container" style="margin-bottom: 50px; max-width:100%;">
    <?= $form->input('name', 'Titre') ?>
    <?= $form->input('slug', 'URL') ?>
    <?= $form->textarea('content', 'Contenu') ?>
    <?= $form->input('created_at', 'Date de création') ?>
    <button class="flex-center" style="margin-top: 40px;" type="submit">
        <div class="btn-primary">
        <?php if($post->getID() !== null): ?>
            Modifier
        <?php else: ?>
            Créer
        <?php endif ?>
        </div>
    </button>
</form>