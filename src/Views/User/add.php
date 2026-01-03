<?php

use App\Core\Form\Form;

?>
<div class="main-content">
    <?php $form = Form::head('', 'post'); ?>
    <h1>Создание нового пользователя</h1>
    <fieldset>
        <?= $form->field($model, 'name'); ?>
        <?= $form->field($model, 'pwd')->passwordField(); ?>
        <?= $form->field($model, 'confirm_pwd')->passwordField(); ?>
        <button type="submit" name="submit">Создать</button>
    </fieldset>
    <?php Form::tail(); ?>
</div>