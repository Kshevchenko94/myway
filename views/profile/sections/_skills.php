<?php

use yii\helpers\Html;

?>

<div class="e2 tab_content" id="tab4">
    <div class="e2_h">Навыки</div>
    <div class="e1_1">Что вы умеете делать:</div>
    <div class="e1_2"><?= $form->field($model, 'skills')->textInput()->label(false) ?></div>
    <div class="button"><?= Html::submitButton('Сохранить') ?></div>
</div>
