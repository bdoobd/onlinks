<script defer src="/public/assets/js/delete_cat.js"></script>
<div class="main-content">
    <h1>Категории</h1>
    <table class="users">
        <caption><a class="new btn" href="/admin/categories/add">Добавить</a></caption>
        <thead>
            <tr>
                <th class="admin-table-header">ID</th>
                <th class="admin-table-header">Name</th>
                <th class="admin-table-header">Action</th>
                <th class="admin-table-header modify">&nbsp;</th>
                <th class="admin-table-header delete">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $row): ?>
                <tr>
                    <td><?= $row->id ?></td>
                    <td><?= $row->name ?></td>
                    <td><?= $row->action ?></td>
                    <td><a href="/admin/categories/<?= $row->id ?>/update" alt="Редактировать ссылку"><img src="/public/assets/img/edit.svg"></a></td>
                    <td><a href="#" alt="Удалить ссылку" data-id="<?= $row->id ?>" data-name="<?= $row->name ?>"><img src="/public/assets/img/delete.svg" data-action="delete"></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="delete-container"></div>
</div>