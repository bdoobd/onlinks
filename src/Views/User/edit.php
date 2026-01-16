<?php

use App\Core\Form\Form;

?>
<div class="main-content">
    <?php $form = Form::head('', 'post'); ?>
    <h1>Сменить пароль пользователя <?= $user ?></h1>
    <?php if (!$current_password) : ?>
        <p class="failed">Не удаётся обновить пароль</p>
    <?php endif; ?>
    <fieldset>
        <?= $form->field($model, 'current_password')->passwordField() ?>
        <?= $form->field($model, 'new_password')->passwordField() ?>
        <?= $form->field($model, 'confirm_new_password')->passwordField() ?>
        <button type="submit" name="submit" id="submit">Изменить пароль</button>
    </fieldset>
    <?php Form::tail(); ?>
</div>