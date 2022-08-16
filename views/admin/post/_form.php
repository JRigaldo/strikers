<form action="" method="POST" class="form__container" style="margin-bottom: 50px; max-width:100%;" enctype="multipart/form-data">
    <?= $form->input('name', 'Titre') ?>
    <?= $form->input('slug', 'URL') ?>
    <?= $form->input('location', 'Location') ?>
    <?= $form->input('website', 'Website') ?>
    <?= $form->input('participation', 'Participation') ?>
    <?= $form->input('sharelink', 'Sharelink') ?>
    <div class="row-top gutter">
        <div class="col-sm-6 col-6 col-md-6">
            <?= $form->file('image', 'Image à la une') ?>
        </div>
        <div class="col-sm-6 col-6 col-md-6">
            <?php if($post->getImage()): ?>
                <img src="<?= $post->getImageURL('small') ?>" alt="" width="100%">
            <?php endif; ?>
        </div>
    </div>
    <?= $form->select('categories_ids', 'Catégories', $categories) ?>
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