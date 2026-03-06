<?php

use App\Core\Form\Form;

?>
<div class="main-content">
    <?php $form = Form::head('', 'post'); ?>
    <h1>Создание новой ссылки</h1>
    <fieldset>
        <?= $form->select($model, 'blockid', $blocks, $selected); ?>
        <?= $form->field($model, 'name', ['tabindex="2"', 'autofocus']); ?>
        <?= $form->field($model, 'link', ['tabindex="3"'])->urlField(); ?>
        <?= $form->field($model, 'linknum', ['tabindex="4"'])->numberField(); ?>
        <button type="submit" name="submit" tabindex="5">Создать</button>
    </fieldset>
    <?php Form::tail(); ?>
</div>