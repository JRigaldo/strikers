<form action="" method="POST" class="form__container" style="margin-bottom: 50px; max-width:100%;">
    <?= $form->input('name', 'Titre') ?>
    <?= $form->input('slug', 'URL') ?>
    <button class="flex-center" style="margin-top: 40px;" type="submit">
        <div class="btn-primary">
        <?php if($item->getID() !== null): ?>
            Modifier
        <?php else: ?>
            Créer
        <?php endif ?>
        </div>
    </button>
</form>