<?php

use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Goals */
/* @var $stages app\models\Stages */

$this->title = 'Редактировать: '.$model->goal;
$this->registerJsFile('/js/goals.js',['depends' => [\yii\web\JqueryAsset::className()]]);

?>
<div class="margin_index1">
    <?php
    $form = ActiveForm::begin([
        'id' => 'form-input-goal-update',
        'options' => [
            'enctype' => 'multipart/form-data'
        ],
    ]);
    Pjax::begin(['id'=>'pjax-form-input-goal-update', 'enablePushState'=>false]);
    ?>
    <div class="goal" data-goal_id="<?=$model->id?>">
        <div class="g_h"><?=($model->is_public)? $form->field($model, 'goal')->textInput(['placeholder'=>'Что вы хотите?','class'=>'input_goal'])->label(false).'&nbsp;<span class="glyphicon glyphicon-lock"></span>'.$form->field($model, 'is_public')->checkbox(['label' => 'Не показывать цель людям']):
                $form->field($model, 'goal')->textInput(['placeholder'=>'Что вы хотите?','class'=>'input_goal'])->label(false).
                '<span class="glyphicon glyphicon-lock"></span>'.$form->field($model, 'is_public')->checkbox(['label' => 'Не показывать цель людям'])
            ?>
            <?=$this->render('_list_options',['model'=>$model, 'update'=>true])?>
        </div>
        <div class="g_g1">До <?=$form->field($model, 'date_finish_goal')->label(false)->widget(
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

        <div class="g_g8">
            <div class="g_g6"><div class="goal_menu_right_7" style="background:<?=$model->categoryGoal->color_code?>;"><?=$form->field($model, 'category_goal')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\CriteriesGoals::getCriteriesGoals(),'id','name'),['prompt' => 'Выберите один вариант'])->label(false)?></div></div>
            <div class="g_g7"><?=$form->field($model, 'priority_goal')->radioList(
                    \yii\helpers\ArrayHelper::map(\app\models\PrioritiesGoals::getPrioritiesGoals(),'id','name'),['encode'=>false]
                )->label(false)?></div>
        </div>
        <div class="g_g2">Критерий завершения цели:</div>
        <div class="g_g3"><?=$form->field($model, 'criterion_fifnish_goal')->textInput(['placeholder'=>'Критерий завершения цели','class'=>'input_goal'])->label(false)?></div>
        <div class="g_g2">Зачем мне эта цель:</div>
        <div class="g_g3"><?=$form->field($model, 'need_goal')->textInput(['placeholder'=>'Зачем вам эта цель?','class'=>'input_goal'])->label(false);?></div>
        <?php if($model->doc):?>
            <div class="g_g4"><span id="delete_photo_update_goal" class="glyphicon glyphicon-remove"></span><a data-lightbox="<?=$model->doc?>" href="/web/img/uploads/<?=$model->doc?>"><img src="/web/img/uploads/<?=$model->doc?>" alt=""></a></div>
        <?php else: ?>
            <div class="ag_6"><?=$form->field($model, 'doc')->fileInput()->label(false);?></div>
        <?php endif; ?>
        <div class="g_g5">
            <div class="g_like">123</div>
            <!--<div class="g_star">Следить за целью</div>-->
        </div>
        <?php Pjax::end(); ?>

    </div>
        <?php
        if($stages):
                echo $this->render('_stage',['model'=>$model,'stages'=>$stages, 'form'=>$form, 'update'=>true]);
        elseif (!$stages):
            Pjax::begin(['enablePushState'=>false]);
            echo \yii\helpers\Html::a('Добавить этапы', ['/goals/add-stages'],['class'=>'btn btn-block btn-primary']);
            Pjax::end();
        endif;?>
<?php ActiveForm::end();?>
</div>