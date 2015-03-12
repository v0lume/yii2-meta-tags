<?php
/**
 * Created by PhpStorm.
 * User: artemshmanovsky
 * Date: 12.03.15
 * Time: 20:12
 */
?>

<?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

<?= $form->field($model, 'keywords')->textInput(['maxlength' => 255]) ?>

<?= $form->field($model, 'description')->textArea() ?>