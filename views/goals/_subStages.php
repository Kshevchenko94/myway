<?php
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Html;

/* @var $subStages app\models\Substage */



DynamicFormWidget::begin(
    [
        'widgetContainer' => 'dynamicform_inner', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-substage', // required: css class selector
        'widgetItem' => '.substage_item', // required: css class
        'limit' => 10, // the maximum times, an element can be cloned (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-substage', // css class
        'deleteButton' => '.remove-substage', // css class
        'model' => $subStages[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'text',
        ],
    ]);
?>
    <div class="container-substage" ><!-- widgetContainer -->
        <?php foreach ($subStages as $i => $modelSubStages): ?>
            <div class="substage_item panel panel-default"><!-- widgetBody -->
                    <?php
                    // necessary for update action.
                    if (! $modelSubStages->isNewRecord) {
                        echo Html::activeHiddenInput($modelSubStages, "[{$i}]id");
                    }
                    ?>
                    <?=$form->field($modelSubStages, "[{$indexStage}][{$i}]text")->textInput(['placeholder'=>'Текст подэтапа'])->label(false)?>

                <div class="panel-footer">
                    <div class="pull-right">
                        <button type="button" class="add-substage btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                        <button type="button" class="remove-substage btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
<?php
DynamicFormWidget::end();
