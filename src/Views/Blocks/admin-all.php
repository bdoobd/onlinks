<script defer src="/public/assets/js/delete_block.js"></script>
<div class="main-content">
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
        <?php foreach ($data as $block) : ?>
            <tbody>
                <tr>
                    <td colspan="3" class="category-title"><?= $block['cat'] ?></td>
                    <td colspan="2" class="add-new-block-button"><a class="new btn" href="/admin/blocks/<?= $block['catId'] ?>/add">Добавить</a></td>
                </tr>
                <?php foreach ($block['blocks'] as $row): ?>

                    <tr>
                        <td class="center"><?= $row['blockId'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td class="center"><?= $row['itemnum'] ?></td>
                        <td class="center action"><a href="/admin/blocks/<?= $row['blockId'] ?>/update" alt="Редактировать блок"><img src="/public/assets/img/edit.svg"></a></td>
                        <td class="center action"><a href="#" alt="Удалить ссылку"><img src="/public/assets/img/delete.svg" data-action="delete" data-id="<?= $row['blockId'] ?>" data-name="<?= $row['name'] ?>"></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        <?php endforeach; ?>
    </table>
    <div class="delete-container"></div>
</div>