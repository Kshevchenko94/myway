<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->registerJsFile('/js/goals.js',['depends' => [\yii\web\JqueryAsset::className()]]);

?>
<div class="ag_1"><img src="/web/img/addgoal.jpg" alt=""></div>
<div class="ag_2">
    <?php
        $form = ActiveForm::begin([
            'id' => 'form-input-goal',
            'options' => [
                'enctype' => 'multipart/form-data'
            ],
        ]);
    ?>
    <div class="ag_7_1">Напишите цель</div>
    <div class="ag_6"><?=$form->field($model, 'goal')->textInput(['placeholder'=>'Что вы хотите?','class'=>'input_goal'])->label(false);?></div>
    <div class="ag_7_1">Когда цель должна быть достигнута?</div>
    <div class="ag_6"><?=$form->field($model, 'date_finish_goal')->label(false)->widget(
                \kartik\datecontrol\DateControl::className(),
                [
                    'type'=>\kartik\datecontrol\DateControl::FORMAT_DATE,
                    'ajaxConversion'=>false,
                    'widgetOptions' => [
                        'pluginOptions' => [
                            'autoclose' => true,
                            'startDate'=>date('d/m/Y')
                        ]
                    ]
                ]
            );?></div>
    <div class="ag_7_1">Как вы поймете, что цель достигнута?</div>
    <div class="ag_6"><?=$form->field($model, 'criterion_fifnish_goal')->textInput(['placeholder'=>'Критерий завершения цели','class'=>'input_goal'])->label(false);?></div>
    <div class="ag_7_1">Для чего вам эта цель? Что вы получите?</div>
    <div class="ag_6"><?=$form->field($model, 'need_goal')->textInput(['placeholder'=>'Зачем вам эта цель?','class'=>'input_goal'])->label(false);?></div>
    <div class="ag_7_1">Выберите категорию цели</div>
    <div class="ag_7_2"><?=$form->field($model, 'category_goal')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\CriteriesGoals::getCriteriesGoals(),'id','name'),['prompt' => 'Выберите один вариант'])->label(false);?></div>
    <div class="ag_7_1">Выберите приоритет цели</div>
    <div class="ag_7_2"><?=$form->field($model, 'priority_goal', ['inline'=>true])->radioList(
            \yii\helpers\ArrayHelper::map(\app\models\PrioritiesGoals::getPrioritiesGoals(),'id','name'),['encode'=>false]
        )->label(false);?></div>
    <div class="ag_6"><?=$form->field($model, 'is_public')->checkbox(['label' => 'Не показывать цель людям']);?></div>
    <?php \yii\widgets\Pjax::begin(['enablePushState'=>false])?>
    <div class="addplan"><a href="<?=\yii\helpers\Url::to(['/goals/add-stages/',])?>">Добавить план достижения цели</a></div>
    <?php \yii\widgets\Pjax::end()?>
    <div class="button add_goal_button"><?=Html::submitButton('Добавить цель');?></div>

</div>
<div class="ag_7">
    <div class="ag_addphoto"><img src="/web/img/icon/addphoto.svg" alt=""></div>

        <div><span class="glyphicon glyphicon-remove"></span><?=Html::img('/web/img/uploads/'.$model->doc)?></div>

        <div class="ag_6"><?=$form->field($model, 'doc')->fileInput()->label(false);?></div>
</div>
<?php ActiveForm::end(); ?>