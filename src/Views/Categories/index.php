<div class="main-content">
    <?php foreach ($data as $block) : ?>
        <div class="content-block">
            <h2 class="content-block-title"><?= $block['name'] ?></h2>
            <ul class="content-block-links">
                <?php foreach ($block['links'] as $item) : ?>
                    <li class="content-block-item"><a href="<?= $item['url'] ?>" class="content-block-link"><?= $item['name'] ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endforeach; ?>
</div>