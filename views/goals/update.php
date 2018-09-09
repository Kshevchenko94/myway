<?php

use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Goals */
/* @var $stages app\models\Stages */

$this->title = 'Редактировать: '.$model->goal;
$this->registerJsFile('/js/goals.js',['depends' => [\yii\web\JqueryAsset::className()]]);

?>
<div class="margin_index1" id="form-input-goal-update">
    <?php Pjax::begin(['id'=>'pjax-form-input-goal-update'])?>
    <?= $this->render('_form', ['model' => $model, 'stages'=>$stages, 'subStages'=>$subStages]) ?>
    <?php Pjax::end()?>
</div>