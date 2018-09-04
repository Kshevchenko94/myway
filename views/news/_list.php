<?php
use yii\widgets\Pjax;

Pjax::begin(['id'=>'news_'.$model->id]);
?>
<div id="news">
<?php if(!$model->text && !$model->section && $model->id_goal):?>
    <?=$this->render('_goal',['model'=>$model])?>
<?php else:?>
    <?=$this->render('_post',['model'=>$model])?>
</div>

<?php
endif;
Pjax::end();
?>