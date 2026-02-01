<div class="main-content">
    <?php foreach ($data as $block) : ?>
        <table class="admin-section-table">
            <caption><?= $block['block'] ?></caption>
            <thead>
                <tr>
                    <td class="admin-table-header">ID</td>
                    <td class="admin-table-header">Name</td>
                    <td class="admin-table-header">&nbsp;</td>
                    <td class="admin-table-header">&nbsp;</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($block['links'] as $row): ?>
                    <tr>
                        <td><?= $row['linkId'] ?></td>
                        <td><?= $row['item'] ?></td>
                        <td><a href="#" alt="Редактировать ссылку"><img src="/public/assets/img/edit.svg"></a></td>
                        <td><a href="#" alt="Удалить ссылку"><img src="/public/assets/img/delete.svg"></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endforeach; ?>
</div>