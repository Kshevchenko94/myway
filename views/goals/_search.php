<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GoalsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'id'=>'filter_goals',
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

<div class="goal_menu_right">

    <div class="goal_menu_right_2">
        <?=$form->field($model, 'status')->radioList(['1'=>'Активные цели','2'=>'Выполненные цели','3'=>'Проваленные цели'],
            [
                'data-toggle'=>'buttons',
                'item' => function ($index, $label, $name, $checked, $value) {
                    return '<label class="btn btn-block  goal_menu_right_1' . ($checked ? ' active' : '') . '">' .
                        Html::radio($name, $checked, ['value' => $value, 'class' => 'status text-left']) . $label . '</label>';
                },
            ]
        )->label(false)?>
    </div>
    <div class="goal_menu_right_3">
        <div class="goal_menu_right_5">
            <div class="goal_menu_right_4">Группы целей</div>
            <?=$form->field($model, 'category_goal')->checkboxList(\yii\helpers\ArrayHelper::map(\app\models\CriteriesGoals::getCriteriesGoals(),'id','name'),[
                'itemOptions' => ['class'=>'goal_menu_right_7 group_goals', 'style'=>'color:'.\app\models\CriteriesGoals::getCriteriesGoals()[0]['color_code'].';']
            ])->label(false)?>
        </div>
    </div>
    <div class="goal_menu_right_3">
        <div class="goal_menu_right_5">
            <div class="goal_menu_right_4">Приоритет целей</div>
            <?=$form->field($model, 'priority_goal')->checkboxList(
                \yii\helpers\ArrayHelper::map(\app\models\PrioritiesGoals::getPrioritiesGoals(),'id','name'),
                [
                    'encode'=>false,
                    'itemOptions'=>['class'=>'priority_goal'],
                ]
            )->label(false);?>
            <!--<div class="goal_menu_right_5"><label><input type="checkbox">&#128293;&#128293;&#128293;</label></div>-->
        </div>
    </div>
</div>
    <?php ActiveForm::end(); ?>
