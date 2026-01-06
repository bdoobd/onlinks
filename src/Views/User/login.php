<?php

use App\Core\Form\Form;
?>
<div class="login-content">
    <?php $form = Form::head('', 'post'); ?>
    <fieldset>
        <div class="close-block"><a href="/" alt="Close login">close</a></div>
        <?= $form->field($model, 'name'); ?>
        <?= $form->field($model, 'pwd')->passwordField(); ?>
        <button type="submit" name="submit">Вход</button>
    </fieldset>
    <?= Form::tail(); ?>
</div>