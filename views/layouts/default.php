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
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<header class="header-relative header-height-60">
    <nav class="padding-5 flex-center space-between">
        <div style="display: block; height: 100%; width:60px;">
            <a href="#" class="flex-center" style="display: none;"><img src="images/icons/back-arrow-icon.svg"
                                                                        alt=""></a>
        </div>
        <a class="header--logo flex-center" href="#" title="Accueil" style="width:calc(100% - 120px);">
            <img alt="Logo strikers" src="images/logos/logo-strikers.svg"/>
        </a>
        <div style="display: block; height: 100%; width:60px;">
            <a href="#" class="flex-center"><img src="images/icons/user-icon.svg" alt=""></a>
        </div>
    </nav>
</header

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
<script src="../js/form.js"></script>
</body>
</html>

