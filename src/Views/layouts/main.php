<?php

use App\Models\Categories;
use App\Core\App;

$categories = Categories::findAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <?= $this->getMeta(); ?>
    <link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/assets/style/reset.css">
    <link rel="stylesheet" href="/assets/style/style.css">
    <script defer src="/assets/js/header_menu.js"></script>
    <title><?= $this->title ?></title>
</head>

<body>
    <div class="main-container">
        <header class="header">
            <div class="header-content">
                <a class="logo" href="#">OnLk</a>
                <nav class="nav">
                    <ul class="menu-list">
                        <?php foreach ($categories as $category) : ?>
                            <li class="menu-item"><a href="/categories/<?= $category->id ?>/<?= $category->action ?>" class="menu-link"><?= $category->name ?></a></li>
                        <?php endforeach; ?>
                        <li class="menu-item"><a href="/user/login" class="menu-link">Login</a></li>
                    </ul>
                </nav>
                <div class="hamburger">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>
            </div>
        </header>
        <main>
            <?php if (App::$app->session->hasPopups()): ?>
                <div class="popup">
                    <div class="popup-message <?= App::$app->session->getPopupKey() ?>">
                        <div class="popup-item"><?= App::$app->session->getPopup() ?></div>
                    </div>
                </div>
            <?php endif; ?>
            {{content}}
        </main>
        <aside>
            <div class="side-block">
                <p><strong>10.12.2025</strong> Lorem ipsum dolor sit amet.</p>
            </div>
            <div class="side-block">
                <p><strong>10.12.2025</strong> Lorem ipsum dolor sit amet.</p>
            </div>
            <div class="side-block">
                <p><strong>10.12.2025</strong> Lorem ipsum dolor sit amet.</p>
            </div>
            <div class="side-block">
                <p><strong>10.12.2025</strong> Lorem ipsum dolor sit amet.</p>
            </div>
            <div class="side-block">
                <p><strong>10.12.2025</strong> Lorem ipsum dolor sit amet.</p>
            </div>
            <?= $this->getMeta(); ?>
        </aside>
        <footer class="footer">
            <div class="footer-content">
                <em>&cross; 2025; Lorem ipsum dolor sit amet.</em>
            </div>
        </footer>
    </div>
</body>

</html>