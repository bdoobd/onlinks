<script src="/public/assets/js/delete_link.js" defer></script>
<div class="main-content">
    <table class="admin-section-table">
        <thead>
            <tr>
                <th class="admin-table-header id">ID</th>
                <th class="admin-table-header">Название</th>
                <th class="admin-table-header modify">Ордер</th>
                <th class="admin-table-header modify">&nbsp;</th>
                <th class="admin-table-header delete">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $block) : ?>
                <tr>
                    <td colspan="3" class="category-title"><?= $block['block'] ?></td>
                    <td colspan="2" class="add-new-block-button"><a class="new btn" href="/admin/links/<?= $block['blockId'] ?>/add/<?= $block['catId'] ?>">Добавить</a></td>
                </tr>
                <?php foreach ($block['links'] as $row): ?>
                    <tr>
                        <td><?= $row['linkId'] ?></td>
                        <td><?= $row['item'] ?></td>
                        <td class="center"><?= $row['linknum'] ?></td>
                        <td class="center action"><a href="/admin/links/<?= $row['linkId'] ?>/update/<?= $block['blockId'] ?>" alt="Редактировать ссылку"><img src="/public/assets/img/edit.svg"></a></td>
                        <td class="center action"><a href="#" alt="Удалить ссылку"><img src="/public/assets/img/delete.svg" data-action="delete" data-id="<?= $row['linkId'] ?>" data-name="<?= $row['item'] ?>"></a></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
        <div class="delete-container"></div>
    </table>
</div>