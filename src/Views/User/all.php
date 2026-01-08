<div class="main-content">
    <h1>Пользователи</h1>

    <table class="users">
        <caption><a class="new btn" href="/admin/user/add">Добавить</a></caption>
        <thead>
            <tr>
                <th class="id">ID</th>
                <th>Имя пользователя</th>
                <th>Создан</th>
                <th class="modify">&nbsp;</th>
                <th class="delete">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?= $user->id ?></td>
                    <td><?= $user->name ?></td>
                    <td><?= $user->created ?></td>
                    <td><a href="/user/<?= $user->id ?>/edit" alt="Edit user"><img src="/public/assets/img/edit.svg" alt="Edit user"></a></td>
                    <td><a href="/user/<?= $user->id ?>/delete" alt="Delete user"><img src="/public/assets/img/delete.svg" alt="Delete user"></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>