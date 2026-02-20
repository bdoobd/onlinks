<?php

use App\Core\Form\Form;

?>
<div class="main-content">
    <?php $form = Form::head('', 'post'); ?>
    <h1>Создание нового блока</h1>
    <fieldset>
        <?= $form->select($model, 'catId', $cats, $selected); ?>
        <?= $form->field($model, 'name', ['tabindex="2"', 'autofocus']); ?>
        <?= $form->field($model, 'itemnum', ['tabindex="3"']); ?>
        <button type="submit" name="submit" tabindex="4">Создать</button>
    </fieldset>
    <?php Form::tail(); ?>
</div>