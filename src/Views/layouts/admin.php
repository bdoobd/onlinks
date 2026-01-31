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
                        <?php if (!App::$app->user): ?>
                            <li class="menu-item"><a href="/user/login" class="menu-link">Login</a></li>
                        <?php else: ?>
                            <li class="menu-item"><a href="/user/logout" class="menu-link"><?= App::$app->user->getUserName() ?> [logout]</a></li>
                        <?php endif; ?>
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
            <?php foreach ($categories as $category): ?>
                <div class="admin-side-block">
                    <p><a href="/admin/categories/<?= $category->id ?>/admin-<?= $category->action ?>" class="category-link"><?= $category->name ?></a></p>
                </div>
            <?php endforeach; ?>
            <div class="admin-side-block">
                <p><a href="/admin/user/all" class="category-link">Пользователи</a></p>
            </div>
        </aside>
        <footer class="footer">
            <div class="footer-content">
                <em>&cross; 2025; Admin panel.</em>
            </div>
        </footer>
    </div>
</body>

</html>