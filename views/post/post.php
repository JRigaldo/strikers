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
    <section class="section__banner section__banner-post">
        <a href="#"><h4 class="section__title"></h4></a>
            <article class="post">
                <div class="article__category">
                    <?php foreach ($post->getCategories() as $category): ?>
                        <?php $category_url = $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]) ?>
                        <a href="<?= $category_url ?>"><?= $category->getName() ?></a>
                    <?php endforeach; ?>
                </div>
                <div class="article__image">
                    <img src="/images/pictures/image-1.jpg" alt="">
                </div>
                <h1 class="article__title"><span class="title-date"><?= $post->getCreatedAt()->format('d.m.Y') ?></span>Sur la place Tarir</h1>
                <div class="article__content padding-5">
                    <h2><?= e($post->getName()) ?></h2>
                    <p><?= $post->getFormatedContent() ?></p>
                </div>
                <div class="article__footer flex-center space-between">
                    <button><a href="#" class="article__footer--link">https://xrlausanne.ch</a></button>
                    <button><a href="#" class="article__footer--btn">Participer</a></button>
                    <button><a href="#" class="article__footer--btn--icon"><img src="images/icons/share-icon.svg"
                                                                                alt=""></a></button>
                </div>
            </article>
    </section>
</main>