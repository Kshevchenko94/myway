<?php

use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Html;

/* @var $stages app\models\Stages */
/* @var $subStages app\models\Substage */

$js = '
$(".dynamicform_wrapper").on(\'afterInsert\', function(e, item) {
        var datePickers = $(this).find(\'[data-krajee-kvdatepicker]\');
        datePickers.each(function(index, el) {
            $(this).parent().removeData().kvDatepicker(\'initDPRemove\');
            $(this).parent().kvDatepicker(eval($(this).attr(\'data-krajee-kvdatepicker\')));
        });
});
';

$this->registerJs($js, yii\web\View::POS_END);

?>
<div class="div_stages" style="<?=($model->id)? "display: none":null?>" >
    <div class="ag_3">План достижения цели</div>
    <div class="container_plan">
<?php
DynamicFormWidget::begin(
    [
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 10, // the maximum times, an element can be cloned (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $stages[0],
        'formId' => 'form-input-goal',
        'formFields' => [
            'title',
            'description',
            'date_finish_stage',
        ],
    ]);
?>
<div class="container-items" ><!-- widgetContainer -->
            <?php foreach ($stages as $i => $modelStages): ?>
        <div class="item panel panel-default" data-stageId="<?=($modelStages->id) ? $modelStages->id:null ?>"><!-- widgetBody -->
            <div class="panel-body">
                <?php
                // necessary for update action.
                if (! $modelStages->isNewRecord) {
                    echo Html::activeHiddenInput($modelStages, "[{$i}]id");
                }
                ?>
                <?=$form->field($modelStages, "[{$i}]title")->textInput(['placeholder'=>'Название этапа'])->label(false)?>
                <?=$form->field($modelStages, "[{$i}]description")->textarea(['placeholder'=>'Описание этапа'])->label(false)?>
                <?=$form->field($modelStages, "[{$i}]date_finish_stage")->widget(\kartik\date\DatePicker::className(),
                    [
                        'options' => [
                            'pluginOptions' => [
                                'autoclose' => true,
                                'startDate'=>date('d-m-Y')
                            ]
                        ]
                    ])->label(false)?>
                <?php/*$this->render('_subStages', [
                    'form' => $form,
                    'indexStage' => $i,
                    'subStages' => $subStages[$i],
                ]);*/
                ?>

            </div>
            <div class="panel-footer">
                <div class="pull-right">
                    <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                    <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <?php endforeach; ?>


    </div>
        <button type="button" class="add-stages-for-update btn btn-primary btn-block hidden">Добавить этапы</button>
<?php
DynamicFormWidget::end();

?>
    </div>
</div>

