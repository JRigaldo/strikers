<?php $title="Publication"; ?>
<?php

    use \App\Connection;
    use \App\Model\{Post, Category};
    use \App\Table\PostTable;
    use \App\Table\CategoryTable;

    $id = (int)$params['id'];
    $slug = $params['slug'];

    $pdo = Connection::getPDO();
    $post = (new PostTable($pdo))->find($id);
    (new CategoryTable($pdo))->hydratePost([$post]);

    if($post->getSlug() !== $slug){
        $url = $router->url('post', [$slug => $post->getSlug(), 'id' => $id]);
        http_response_code(301);
        header('Location: ' . $url);
    }
?>
<main>
    <section>
        <div class="section__banner">
            <div class="section__banner-post"></div>
        </div>
            <article class="post">
                <div class="article__image">
                    <?php if($post->getImage()): ?>
                        <img src="<?= $post->getImageURL('large') ?>" alt="">
                    <?php endif; ?>
                </div>
                <h1 class="article__title"><span class="title-date"><?= $post->getCreatedAt()->format('d.m.Y') ?></span><?php if($post->getLocation()): ?><?= $post->getLocation() ?><?php endif; ?></h1>
                <div class="container-small">
                    <div class="article__container">
                        <div class="article__content padding-5">
                            <div class="article__category">
                                <?php foreach ($post->getCategories() as $category): ?>
                                    <?php $category_url = $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]) ?>
                                    <a href="<?= $category_url ?>"><?= $category->getName() ?></a>
                                <?php endforeach; ?>
                            </div>
                            <h2><?= e($post->getName()) ?></h2>
                            <p><?= $post->getFormatedContent() ?></p>
                        </div>
                        <div class="article__footer flex-center space-between">
                            <?php if($post->getWebsite()): ?><button><a href="<?= $post->getWebsite() ?>" class="article__footer--link"><?= $post->getWebsite() ?></a></button><?php endif; ?>
                            <?php if($post->getParticipation()): ?><button><a href="<?= $post->getparticipation() ?>" class="article__footer--btn">Participer</a></button><?php endif; ?>
                            <?php if($post->getSharelink()): ?><button><a href="<?= $post->getSharelink() ?>" class="article__footer--btn--icon"><img src="/images/icons/share-icon.svg" alt=""></a></button><?php endif; ?>
                        </div>
                    </div>
                </div>
            </article>

    </section>
</main>