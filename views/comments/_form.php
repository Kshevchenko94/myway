<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Comments */
/* @var $form yii\widgets\ActiveForm */
?>


<?php $form = ActiveForm::begin(['action' => ['comments/create'],'fieldConfig'=>['template'=>"{error}\n{label}\n{input}"]]); ?>

<?= $form->field($model, 'text')->textInput(['placeholder'=>'Напишите комментарий...','class'=>'news_comment'])->label(false) ?>

<?= $form->field($model, 'id_element')->hiddenInput(['value'=>$id_element])->label(false) ?>

<?= $form->field($model, 'section')->hiddenInput(['value'=>$section])->label(false) ?>


	<?= Html::button('', ['class' => 'button_news btn_comment']) ?>


<?php ActiveForm::end(); ?>

