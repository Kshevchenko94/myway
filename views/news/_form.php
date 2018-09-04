<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\popover\PopoverX;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="add_news">
	
	<?php $form = ActiveForm::begin(['id'=>'news_form','action' => ['news/create'],'options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="add_news_1"><?= $form->field($model, 'text')->textarea(['class' => 'add_news_text', 'placeholder'=>'Добавить запись…'])->label(false) ?></div>
	
    <div class="add_news_1"><?= $form->field($model, 'file')->fileInput()->label(false) ?>

    <?php PopoverX::begin(['id'=>'myPopover1','header' => 'Выбирете цель', 'size'=>PopoverX::SIZE_LARGE ,'placement' => PopoverX::ALIGN_BOTTOM,'toggleButton' => ['label'=>false, 'class'=>'btn btn-default glyphicon glyphicon-flag'],]);
        echo $form->field($model, 'id_goal')->widget(\kartik\select2\Select2::className(),
        [
            'data' => ArrayHelper::map(\app\models\Goals::getSelectGoals(),'id','goal') ,
            'options' => ['placeholder' => 'Выбрать цель ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
            'pluginEvents' => [
                "change" => "function() { $('#myPopover1').popoverX('hide'); }",
            ],
        ])->label(false);
	PopoverX::end(); ?>
	</div>
	
    <div class="add_news_1"><?= Html::Button('Сохранить', ['class' => 'button', 'id'=>'save_btn']) ?></div>

    <?php ActiveForm::end();?>
</div>
