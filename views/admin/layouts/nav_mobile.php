<aside class="nav__mobile menu-mobile" id="mobile-menu">
    <div class="aside-menu__icon close" id="mobile-cross">
        <div class="icon--container">
            <div class="w50--icon">
                <svg height="34.243" viewbox="0 0 34.243 34.243" width="34.243" xmlns="http://www.w3.org/2000/svg">
                    <g data-name="Groupe 1" id="Groupe_1" transform="translate(-216.379 -174.379)">
                        <line data-name="Ligne 1" fill="none" id="Ligne_1" stroke-linecap="round" stroke-width="3"
                              transform="translate(218.5 176.5)" x2="30" y2="30"/>
                        <line data-name="Ligne 2" fill="none" id="Ligne_2" stroke-linecap="round" stroke-width="3"
                              transform="translate(218.5 176.5)" x1="30" y2="30"/>
                    </g>
                </svg>
            </div>
            <span>Close</span>
        </div>
    </div>
    <div class="block--container">
        <nav>
            <ul>
                <li><a href="<?= $router->url('admin_posts') ?>">Articles</a></li>
                <li><a href="<?= $router->url('admin_categories') ?>">Categories</a></li>
                <li><form action="<?= $router->url('logout') ?>" method="POST" style="display: inline;"><button type="submit">Déconnexion</button></form></li>
            </ul>
        </nav>
    </div>
</aside>