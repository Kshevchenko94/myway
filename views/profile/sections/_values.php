<?php

use yii\helpers\Html;

?>

<div class="e2 tab_content" id="tab5">
    <div class="e2_h">Ценности</div>
    <div class="e1_1">Ценность:</div>
    <div class="e1_2"><?= $form->field($values, 'value')->textInput()->label(false) ?></div>
    <div class="e1_1">Почему для вас это ценно?:</div>
    <div class="e1_2"><?= $form->field($values, 'description')->textarea()->label(false) ?></div>
    <br>
    <div class="e1_5"><?= Html::submitButton('Добавить ценность') ?></div>
    <hr/>

</div>
