<article class="article">
    <div class="article__category">
        <a href="#">egypte</a><a href="#">caire</a>
    </div>
    <a href="<?= $router->url('post', ['id'=> $post->getID(), 'slug'=> $post->getSlug()]) ?>">
        <div class="article__image">
            <img src="/images/pictures/image-1.jpg" alt="">
        </div>
        <h1 class="article__title"><span class="title-date"><?= $post->getDateTime()->format('d.m.Y') ?></span>Sur la place Tarir</h1>
        <div class="article__content padding-5">
            <h2><?= htmlentities($post->getName()) ?></h2>
            <p><?= $post->getExcerpt(); ?></p>
        </div>
    </a>
    <div class="article__footer flex-center space-between">
        <button><a href="#" class="article__footer--link">https://xrlausanne.ch</a></button>
        <button><a href="#" class="article__footer--btn">Participer</a></button>
        <button><a href="#" class="article__footer--btn--icon"><img src="/images/icons/share-icon.svg"
                                                                    alt=""></a></button>
    </div>
</article>