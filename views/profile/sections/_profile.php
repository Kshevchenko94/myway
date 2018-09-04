<?php

use yii\helpers\Html;
use yii\web\JsExpression;

$resultsJs = <<< JS
function (data) {
    return {
        results: data.result
    };
}
JS;

?>
<div class="e2 tab_content" id="tab1">
    <div class="e2_h">Основная информация</div>
    <div class="e1_1">Фотография профиля</div>
    <div class="e1_2"><?= $form->field($model, 'avatar')->fileInput()->label(false) ?></div>
    <div class="e1_1">Имя</div>
    <div class="e1_2"><?= $form->field($model, 'name')->textInput()->label(false) ?></div>
    <div class="e1_1">Фамилия</div>
    <div class="e1_2"><?= $form->field($model, 'surname')->textInput()->label(false) ?></div>
    <div class="e1_1">Дата рождения</div>
    <div class="e1_2"><?=$form->field($model, 'date_birth')->widget(
            \kartik\datecontrol\DateControl::className(),
            [
                'ajaxConversion'=>false,
                'type'=>\kartik\datecontrol\DateControl::FORMAT_DATE,
                'widgetOptions' => [
                    'pluginOptions' => [
                        'autoclose' => true,
                        'mask' => '99.99.9999',
                    ]
                ]
            ]
        )->label(false) ?></div>
    <div class="e1_1">Пол</div>
    <div class="e1_2"><?= $form->field($model, 'sex')->dropDownList(['m'=>'Мужской','w'=>'Женский'])->label(false) ?></div>
    <div class="e1_1">Город</div>
    <div class="e1_2"><?= $form->field($model, 'city_id')->widget(\kartik\select2\Select2::className(),
            [
                'options' => ['placeholder' => 'Поиск по городам ...'],
                'initValueText' => 'kartik-v/yii2-widgets',
                'pluginOptions' => [
                    'allowClear' => true,
                    'minimumInputLength' => 3,
                    'ajax' => [
                        'url' => "/profile/search-cities",
                        'dataType' => 'json',
                        'delay' => 250,
                        'data' => new JsExpression('function(params) { return {query:params.term}; }'),
                        'processResults' => new JsExpression($resultsJs),
                    ],
                    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                    'templateResult' => new JsExpression('function(repo){return repo.name}'),
                    'templateSelection' => new JsExpression('function(repo){return repo.name}'),
                ],
            ]
        )->label(false) ?></div>
    <div class="button"><?= Html::submitButton('Сохранить') ?></div>

</div>
