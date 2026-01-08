<?php

use App\Core\Form\Form;
?>
<div class="login-content">
    <?php $form = Form::head('', 'post'); ?>
    <fieldset>
        <div class="close-block"><a href="/" alt="Close login">close</a></div>
        <?= $form->field($model, 'name', ['taborder="1"', 'autofocus']); ?>
        <?= $form->field($model, 'pwd', ['taborder="2"'])->passwordField(); ?>
        <button type="submit" name="submit">Вход</button>
    </fieldset>
    <?= Form::tail(); ?>
</div>