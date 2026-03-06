<?php
// echo '<pre>';
// var_dump($test);
// echo '</pre>';
?>
<div class="main-content">
    <table class="admin-section-table">
        <thead>
            <tr>
                <th class="admin-table-header id">ID</th>
                <th class="admin-table-header">Название</th>
                <th class="admin-table-header modify">&nbsp;</th>
                <th class="admin-table-header modify">&nbsp;</th>
                <th class="admin-table-header delete">&nbsp;</th>
            </tr>
        </thead>
        <?php foreach ($data as $block) : ?>
            <tbody>
                <tr>
                    <td colspan="2" class="category-title"><?= $block['block'] ?></td>
                    <td colspan="2" class="add-new-block-button"><a class="new btn" href="/admin/links/<?= $block['blockId'] ?>/add/<?= $block['catId'] ?>">Добавить</a></td>
                </tr>
                <?php foreach ($block['links'] as $row): ?>
                    <tr>
                        <td><?= $row['linkId'] ?></td>
                        <td><?= $row['item'] ?></td>
                        <!-- <td class="center action"><a href="/admin/links/<?= $block['blockId'] ?>/add"><img src="/public/assets/img/add.svg" alt="Добавить ссылку"></a></td> -->
                        <td class="center action"><a href="/admin/links/<?= $row['linkId'] ?>/update" alt="Редактировать ссылку"><img src="/public/assets/img/edit.svg"></a></td>
                        <td class="center action"><a href="#" alt="Удалить ссылку"><img src="/public/assets/img/delete.svg" data-action="delete" data-id="<?= $row['linkId'] ?>" data-name="<?= $row['item'] ?>"></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        <?php endforeach; ?>
    </table>
</div>