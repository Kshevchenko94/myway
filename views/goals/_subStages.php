<?php
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Html;

DynamicFormWidget::begin(
    [
        'widgetContainer' => 'dynamicform_inner', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-substage', // required: css class selector
        'widgetItem' => '.substage_item', // required: css class
        'limit' => 10, // the maximum times, an element can be cloned (default 999)
        'min' => 0, // 0 or 1 (default 1)
        'insertButton' => '.add-substage', // css class
        'deleteButton' => '.remove-substage', // css class
        'model' => $subStages[0],
        'formId' => 'form-input-goal',
        'formFields' => [
            'text',
        ],
    ]);
?>
    <div class="container-substage" ><!-- widgetContainer -->
        <?php foreach ($subStages as $i => $modelSubStages): ?>
            <div class="substage_item"><!-- widgetBody -->
                    <?php
                    // necessary for update action.
                    if (! $modelSubStages->isNewRecord) {
                        echo Html::activeHiddenInput($modelSubStages, "[{$indexStage}][{$i}]id");
                    }
                    ?>
                <div class="ag_1_3"><?=$form->field($modelSubStages, "[{$indexStage}][{$i}]text")->textInput(['placeholder'=>'Текст подэтапа'])->label(false)?>
                    <button type="button" class="remove-substage btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="ag_1_3 add-substage">Добавить подэтап</div>
<?php
DynamicFormWidget::end();
