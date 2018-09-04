<?php

use yii\helpers\Html;
use yii\widgets\MaskedInput;

?>

<div class="e2 tab_content" id="tab2">
    <div class="e2_h">Контакты</div>
    <div class="e1_1">Телефон</div>
    <div class="e1_2"><?= $form->field($model, 'telephone')->widget(MaskedInput::className(), ['mask' => '+7 (999) 999-99-99',])->label(false) ?></div>
    <div class="e1_1">Почта</div>
    <div class="e1_2"><?= $form->field($model, 'email')->textInput()->label(false) ?></div>
    <div class="e1_1">Аккаунт в VK</div>
    <div class="e1_2"><?= $form->field($model, 'vk')->textInput()->label(false) ?></div>
    <div class="e1_1">Аккаунт в Instagram</div>
    <div class="e1_2"><?= $form->field($model, 'instagram')->textInput()->label(false) ?></div>
    <div class="e1_1">Аккаунт в Facebook</div>
    <div class="e1_2"><?= $form->field($model, 'facebook')->textInput()->label(false) ?></div>
    <div class="button"><?= Html::submitButton('Сохранить') ?></div>
</div>
