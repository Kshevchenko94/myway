<?php

use kartik\select2\Select2;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;


?>
<?php
Pjax::begin(['id'=>'pjax_update_form','enablePushState'=>false]);
$form = ActiveForm::begin(['action'=>Url::to(['/news/update/', 'id'=>$model->id]), 'options'=>['class'=>['update_news_form']]]);
?>
<div class="n_bl">
    <div class="n_bl_1">
        <div class="n_bl_1_1"><a href="/profile"><img src="<?=($model->user->avatar)? '/web/img/uploads/'.$model->user->avatar:'/web/img/uploads/no_avatar.jpg';?>" alt="" class="new_photo"></a></div>
        <div class="n_bl_1_4">
            <div class="n_bl_1_2"><a href="/profile"><?=$model->user->name?>&nbsp;<?=$model->user->surname?></a></div>
            <div class="n_bl_1_3"><?=Yii::$app->formatter->asDatetime($model->date_create)?></div>
        </div>
        <?php if($model->text && $model->id_goal && !$model->section):?>
            <div class="n_bl_1_7">
                    <div class="n_bl_1_11">
                        <div class="n_bl_1_9">
                            <?=$form->field($model, 'id_goal')->widget(Select2::className(),
                                [
                                    'value' => 'gggggg',
                                    'options' => ['placeholder' => 'Выбрать цель ...'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ])->label(false)?>
                        </div>
                    </div>
            </div>
        <?php endif;?>
    </div>
    <div class="n_bl_2">
        <?=$form->field($model, 'text')->textarea()->label(false)?>
    </div>
    <?php if($model->file): ?>
        <span class="glyphicon glyphicon-remove rm_file" data-id_news="<?=$model->id?>"></span>
        <div class="n_bl_3"><?=Html::img(Url::to('/web/img/uploads/'.$model->file))?></div>
    <?php else: ?>
        <?=$form->field($model, 'file')->fileInput()->label(false)?>
    <?php endif; ?>

</div>
<?php
ActiveForm::end();
Pjax::end();
?>