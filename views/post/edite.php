<?php $title='Edition'; ?>
<main>
    <section class="padding-10 layout">
        <h1>Agendez les grèves à venir</h1>
        <form action="#" class="form__container" style="margin-bottom: 50px;">
            <div class="field">
                <div class="field-label">Titre de l'événement</div>
                <input class="field-input">
            </div>
            <div class="field">
                <div class="field-label">Date</div>
                <input class="field-input">
            </div>
            <div class="field">
                <div class="field-label">Association</div>
                <input class="field-input">
            </div>
            <div class="field">
                <div class="field-label">Mail</div>
                <input class="field-input">
            </div>
            <div class="field">
                <div class="field-label">Lieu du site</div>
                <input class="field-input">
            </div>
            <div class="field-message">
                <div class="field-label-message">Texte</div>
                <textarea class="field-textarea"></textarea>
            </div>
            <div class="field">
                <div class="field-label">Catégorie</div>
                <input class="field-input">
            </div>
            <div class="field-image-label">
                <button class="btn-secondary">Choisir un fichier <img src="images/icons/upload-icon.svg" alt=""><input class="field-image" type="file" id="img" name="img" accept="image/*"></button>
            </div>
            <button class="flex-center" style="margin-top: 40px;"><a href="#" class="btn-primary">Poster</a></button>
        </form>
    </section>
</main>