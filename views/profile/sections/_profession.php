<?php

use yii\helpers\Html;

?>
<div class="e2 tab_content" id="tab3">
    <div class="e2_h">Профессия</div>
    <div class="e1_1">Место работы:</div>
    <div class="e1_2"><?= $form->field($model, 'place_job')->textInput()->label(false) ?></div>
    <div class="e1_1">Должность:</div>
    <div class="e1_2"><?= $form->field($model, 'position')->textInput()->label(false) ?></div>
    <div class="e1_1">Доход в год:</div>
    <div class="e1_2"><?= $form->field($model, 'income')->textInput()->label(false) ?></div>
    <div class="button"><?= Html::submitButton('Сохранить') ?></div>
</div>