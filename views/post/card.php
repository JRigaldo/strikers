<article class="article">
    <div class="article__category">
        <?php if(!empty($post->getCategories())): ?>
        <?php foreach ($post->getCategories() as $category): ?>
            <?php $category_url = $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]) ?>
            <a href="<?= $category_url ?>"><?= $category->getName() ?></a>
        <?php endforeach; ?>
        <?php endif ?>
    </div>
    <a href="<?= $router->url('post', ['id'=> $post->getID(), 'slug'=> $post->getSlug()]) ?>">
        <div class="article__image">
            <?php if($post->getImage()): ?>
                <img src="<?= $post->getImageURL('small') ?>" alt="">
            <?php endif; ?>
        </div>
        <h1 class="article__title"><span class="title-date"><?= $post->getCreatedAt()->format('d.m.Y') ?></span><?php if($post->getLocation()): ?><?= $post->getLocation() ?><?php endif; ?></h1>
        <div class="article__content padding-5">
            <h2><?= htmlentities($post->getName()) ?></h2>
            <p><?= $post->getExcerpt(); ?></p>
        </div>
    </a>
    <div class="article__footer flex-center space-between">
        <?php if($post->getWebsite()): ?><button><a href="<?= $post->getWebsite() ?>" class="article__footer--link"><?= $post->getWebsite() ?></a></button><?php endif; ?>
        <?php if($post->getParticipation()): ?><button><a href="<?= $post->getparticipation() ?>" class="article__footer--btn">Participer</a></button><?php endif; ?>
        <?php if($post->getSharelink()): ?><button><a href="<?= $post->getSharelink() ?>" class="article__footer--btn--icon"><img src="/images/icons/share-icon.svg" alt=""></a></button><?php endif; ?>
    </div>
</article>