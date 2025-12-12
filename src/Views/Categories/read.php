<div class="main-content">
    <h2>Category list</h2>
    <h3><?= ucfirst($route['controller']) ?> Controller, <?= ucfirst($route['action']) ?></h3>
    <div class="cat-list">
        <ul>
            <?php foreach ($model as $cat) : ?>
                <li>Cat ID: <?= $cat->id ?> with name <?= $cat->name ?> => action named <?= $cat->action ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <h3>Page header at bottom side <?= $header ?></h3>
</div>