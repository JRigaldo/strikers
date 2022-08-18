<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/index.css">
    <title><?= isset($title) ? e($title) : "L'agenda des manifs'" ?></title>
</head>
<body>
<header class="header-relative header-height-60">
    <nav class="padding-5 flex-center space-between">
        <div style="display: block; height: 100%; width:60px;">
            <a href="#" class="flex-center" style="display: none;"><img src="/images/icons/back-arrow-icon.svg" alt=""></a>
        </div>
        <div class="header--logo flex-center"
           style="width:calc(100% - 120px);">
            <a href="<?= $router->url('blog') ?>" title="Accueil"><img alt="Logo strikers" src="/images/logos/logo-strikers.svg"/></a>
        </div>
        <div style="display: block; height: 100%; width:60px;">
            <a href="<?= $router->url('admin_posts') ?>" class="flex-center"><img src="/images/icons/user-icon.svg"
                                                                                  alt=""></a>
        </div>
    </nav>
</header
<div class="site-cache"></div>
<?= $content; ?>

<footer>
    <div class="container-footer">
        <ul>
            <li>
                <a href="<?= $router->url('about') ?>">
                    A propos
                </a>
            </li>
            <li>
                <a href="<?= $router->url('organizations') ?>">
                    Les associations
                </a>
            </li>
            <li>
                <a href="<?= $router->url('contributors') ?>">
                    Les contributeurs
                </a>
            </li>
        </ul>
    </div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="/js/form.js"></script>
<p><?= round(1000 * microtime(true) - DEBUG_TIME) ?></p>
</body>
</html>

