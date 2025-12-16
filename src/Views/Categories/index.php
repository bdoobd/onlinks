<div class="main-content">
    <div class="head-title"><?= $info ?></div>
    <div class="block-section">
        <ul class="block-list">
            <?php foreach ($blocks as $block) : ?>
                <li class="block-item">BlockID <?= $block->blockId ?> / name <?= $block->block ?>: link ID <?= $block->linkId ?> link name <?= $block->item ?> url <?= $block->link ?><br></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>