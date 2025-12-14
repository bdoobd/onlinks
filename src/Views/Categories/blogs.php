<div class="main-content">
    <div class="head-title"><?= $info ?></div>
    <div class="block-section">
        <ul class="block-list">
            <?php foreach ($blocks as $block) : ?>
                <li class="block-item">BlockID <?= $block->id ?> / CatID <?= $block->catid ?>: Name <?= $block->name ?> at position <?= $block->itemnum ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>