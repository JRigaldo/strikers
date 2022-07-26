<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title><link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/index.css">
    <title><?= isset($title) ? e($title) : "L'agenda des manifs'" ?></title>
</head>
<body>
<header class="header-main header-relative header-height-60">
    <nav class="padding-5 flex-center space-between">
        <div style="display: block; height: 100%; width:60px;">
            <a href="<?= $router->url('blog') ?>" class="flex-center" style="display: none;"><img src="/images/icons/back-arrow-icon.svg" alt=""></a>
        </div>
        <div style="display: block; height: 100%; width:60px;">
            <a href="<?= $router->url('admin_posts') ?>" class="flex-center"><img src="/images/logos/logo-strikers.svg" alt=""></a>
        </div>
        <div style="display: block; height: 100%; width:60px;">
            <div class="header-menu__icon hamburger" id="mobile-menu-button">
                <div class="icon--container">
                    <span>Menu</span>
                    <div class="w50--icon">
                        <svg height="28" viewbox="0 0 49 28" width="49" xmlns="http://www.w3.org/2000/svg">
                            <g data-name="Groupe 1" id="Groupe_1" transform="translate(-304.5 -24.5)">
                                <line data-name="Ligne 1" fill="none" id="Ligne_1" stroke-linecap="round" stroke-width="4"
                                      transform="translate(306.5 26.5)" x2="45"/>
                                <line data-name="Ligne 2" fill="none" id="Ligne_2" stroke-linecap="round" stroke-width="4"
                                      transform="translate(306.5 38.5)" x2="45"/>
                                <line data-name="Ligne 3" fill="none" id="Ligne_3" stroke-linecap="round" stroke-width="4"
                                      transform="translate(306.5 50.5)" x2="45"/>
                            </g>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
<?php require('nav_mobile.php'); ?>
<div class="site-cache" id="site-cache"></div>
<?= $content; ?>

<footer class="container">
    <ul>
        <li>
            <a href="#">
                A propos
            </a>
        </li>
        <li>
            <a href="#">
                Les associations
            </a>
        </li>
        <li>
            <a href="#">
                Les contributeurs
            </a>
        </li>
    </ul>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="/js/form.js"></script>
<script src="/js/index.js"></script>
<p><?= round(1000 * microtime(true) - DEBUG_TIME) ?></p>
</body>
</html>

