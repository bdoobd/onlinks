<?php

use App\Core\Form\Form;

?>
<div class="main-content">
    <?php $form = Form::head('', 'post'); ?>
    <h1>Создание нового пользователя</h1>
    <fieldset>
        <?= $form->field($model, 'name', ['tabindex="1"', 'autofocus']); ?>
        <?= $form->field($model, 'pwd', ['tabindex="2"'])->passwordField(); ?>
        <?= $form->field($model, 'confirm_pwd', ['tabindex="3"'])->passwordField(); ?>
        <button type="submit" name="submit" tabindex="4">Создать</button>
    </fieldset>
    <?php Form::tail(); ?>
</div>