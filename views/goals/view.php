<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Substage;

/* @var $this yii\web\View */
/* @var $model app\models\Goals */
/* @var $report app\models\News */

$this->title = 'Цель '.$model->goal;
$this->registerJsFile('/js/goals.js',['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCss('ol {
/* убираем стандартную нумерацию */
list-style: none; 
/* Идентифицируем счетчик и даем ему имя li. Значение счетчика не указано - по умолчанию оно равно 0 */ 
counter-reset: stages_li; 
}
.stages li:before {
/* Определяем элемент, который будет нумероваться — li. Псевдоэлемент before указывает, что содержимое, вставляемое при помощи свойства content, будет располагаться перед пунктами списка. Здесь же устанавливается значение приращения счетчика (по умолчанию равно 1). */
counter-increment: stages_li; 
/* С помощью свойства content выводится номер пункта списка. counters() означает, что генерируемый текст представляет собой значения всех счетчиков с таким именем. Точка в кавычках добавляет разделяющую точку между цифрами, а точка с пробелом добавляется перед содержимым каждого пункта списка */
content: counters(stages_li,".") ". "; 
}');
?>
<?php \yii\widgets\Pjax::begin(['id'=>"goal_view_".$model->id, 'enablePushState'=>false])?>
<div class="margin_index1">

<div class="goal">
    <div class="g_h"><?=($model->is_public)? $model->goal.'&nbsp;<span class="glyphicon glyphicon-lock"></span>':$model->goal?>
        <?=$this->render('_list_options',['model'=>$model])?>
    </div>
    <div class="g_g1">До <?=Yii::$app->formatter->asDate($model->date_finish_goal)?></div>
    
    <div class="g_g8">
        <div class="g_g6"><div class="goal_menu_right_7" style="background:<?=$model->categoryGoal->color_code?>;"><?=$model->categoryGoal->name?></div></div>
        <div class="g_g7"><?=$model->priorityGoal->name?></div>
    </div>
    <div class="g_g2">Критерий завершения цели:</div>
    <div class="g_g3"><?=$model->criterion_fifnish_goal?></div>
    <div class="g_g2">Зачем мне эта цель:</div>
    <div class="g_g3"><?=$model->need_goal?></div>
	<?php if($model->doc):?>
    <div class="g_g4"><a data-lightbox="<?=$model->doc?>" href="/web/img/uploads/<?=$model->doc?>"><img src="/web/img/uploads/<?=$model->doc?>" alt=""></a></div>
	<?php endif ?>
    <div class="g_g5">  
        <div class="g_like">123</div>
        <!--<div class="g_star">Следить за целью</div>-->
    </div>  
    <div class="g_h_plan">План достижения цели</div>
    <ol class="stages">
	<?php 
		if($model->stages):
			foreach($model->stages as $key => $stage):
	?>
    <li>
        <div class="g_plan_0">
            <div class="g_plan_1"><?=$stage->title?></div>
            <div class="g_plan_3">До <?=Yii::$app->formatter->asDate($stage->date_finish_stage)?></div>
            <div class="g_plan_2"><?=$stage->description?></div>
            <ol>
                <?php foreach (Substage::findAll(['id_stage'=>$stage->id]) as $subStage):?>
                <li><?=$subStage->text?></li>
                <?php endforeach;?>
            </ol>
        </div>
    </li>

	<?php 
		endforeach;
		endif;
	?>
    </ol>
</div>

<div class="goal_post">
    <div class="goal_day">Что сделали по цели?</div>
<div class="add_news" style="min-height: 100px;">
	<?php $form = ActiveForm::begin(['action' => ['news/create','id_goal'=>$model->id],'options' => ['enctype' => 'multipart/form-data', 'id'=>'report_form']]); ?>

    <div class="add_news_1"><?= $form->field($report, 'text')->textarea(['class' => 'add_news_text', 'placeholder'=>'Добавить запись…'])->label(false) ?></div>
	
    <div class="add_news_1"><?= $form->field($report, 'file')->fileInput()->label(false) ?></div>

    <div class="add_news_1"><?= Html::Button('Добавить', ['class' => 'button', 'id'=>'add_report_goals']) ?></div>

    <?php ActiveForm::end(); ?>
    </div>
</div>


    <div class="goal_post">
        <div class="goal_day">2 День</div>
        <?php foreach ($model->reports as $values):?>
            <?=$this->render('@app/views/news/_post', ['model'=>$values])?>
        <?php endforeach;?>

    </div>

</div>
<?php \yii\widgets\Pjax::end()?>