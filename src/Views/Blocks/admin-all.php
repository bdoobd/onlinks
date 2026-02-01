<div class="main-content">
    <h1>Блоки категорий</h1>
    <?php foreach ($data as $block) : ?>
        <table class="users">
            <caption><a class="new btn" href="/admin/categories/add">Добавить</a></caption>
            <thead>
                <tr>
                    <th class="admin-table-header">ID</th>
                    <th class="admin-table-header">Название</th>
                    <th class="admin-table-header">Порядоквый номер</th>
                    <th class="admin-table-header modify">&nbsp;</th>
                    <th class="admin-table-header delete">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($block['blocks'] as $row): ?>
                    <tr>
                        <td><?= $row['blockId'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['itemnum'] ?></td>
                        <td><a href="#" alt="Редактировать ссылку"><img src="/public/assets/img/edit.svg"></a></td>
                        <td><a href="#" alt="Удалить ссылку"><img src="/public/assets/img/delete.svg"></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endforeach; ?>
</div>