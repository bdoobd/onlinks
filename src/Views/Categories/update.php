<?php

use App\Core\Form\Form;

?>
<div class="main-content">
    <?php $form = Form::head('', 'post'); ?>
    <h1>Редактирование категории</h1>
    <fieldset>
        <?= $form->field($model, 'name', ['tabindex="1"', 'autofocus']); ?>
        <?= $form->field($model, 'action', ['tabindex="2"']); ?>
        <button type="submit" name="submit" tabindex="3">Записать изменеия</button>
    </fieldset>
    <?php Form::tail(); ?>
</div>