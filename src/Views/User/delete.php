<?php

use App\Core\Form\Form;

?>
<div class="main-content">
    <?php $form = Form::head('', 'post'); ?>
    <h1>Удалить пользователя</h1>
    <fieldset>
        <?= $form->field($model, 'name') ?>
    </fieldset>
    <?php Form::tail(); ?>
</div>