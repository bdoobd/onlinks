<div class="main-content">
    <?php foreach ($data as $block) : ?>
        <div class="content-block">
            <h2 class="content-block-title"><?= $block['block'] ?></h2>
            <ul class="content-block-links">
                <?php foreach ($block['links'] as $item) : ?>
                    <li class="content-block-item"><a href="<?= $item['link'] ?>" class="content-block-link"><?= $item['item'] ?></a></li>
                <?php endforeach; ?>
            </ul>
            <div class="content-block-footer">
                <span class="add-item">+</span>
            </div>
        </div>
    <?php endforeach; ?>
</div>