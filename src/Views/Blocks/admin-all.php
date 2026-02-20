<?php
// echo '<pre>';
// var_dump($data);
// echo '</pre>';
?>
<div class="main-content">
    <?php foreach ($data as $block) : ?>
        <h2><?= $block['cat'] ?></h2>
        <p class="add-btn-block"><a class="new btn" href="/admin/blocks/<?= $block['catId'] ?>/add">Добавить</a></p>
        <table class="admin-section-table">
            <thead>
                <tr>
                    <th class="admin-table-header id">ID</th>
                    <th class="admin-table-header">Название</th>
                    <th class="admin-table-header order">Ордер</th>
                    <th class="admin-table-header modify">&nbsp;</th>
                    <th class="admin-table-header delete">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($block['blocks'] as $row): ?>
                    <tr>
                        <td class="center"><?= $row['blockId'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td class="center"><?= $row['itemnum'] ?></td>
                        <td class="center action"><a href="#" alt="Редактировать ссылку"><img src="/public/assets/img/edit.svg"></a></td>
                        <td class="center action"><a href="#" alt="Удалить ссылку"><img src="/public/assets/img/delete.svg"></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endforeach; ?>
</div>