<?php 
use yii\helpers\Url;
use yii\helpers\Html;

\yii\widgets\Pjax::begin(['id'=>'goal_'.$model->id])
?>
<div class="g">
        <?=$this->render('_list_options',['model'=>$model])?>
	  <div class="g_10"><a href="<?=Url::to(['goals/view', 'id'=>$model->id])?>"><img src="<?=($model->doc)? '/web/img/uploads/'.$model->doc:'/web/img/goals/no_photo.png'?>" alt=""></a></div>
	  <div class="g_7">
	      <a href="<?=Url::to(['goals/view', 'id'=>$model->id])?>"><div class="g_2"><?=($model->is_public)? $model->goal.'&nbsp;<span class="glyphicon glyphicon-lock"></span>':$model->goal?></div>
	      <div class="g_3">до <?=Yii::$app->formatter->asDate($model->date_finish_goal)?></div></a>
	      <div class="g_11">
	          <div class="g_6"><?=$model->priorityGoal->name?></div>
	          <div class="g_12"><div class="goal_menu_right_7" style="background: <?=$model->categoryGoal->color_code?>;"><?=$model->categoryGoal->name?></div></div>
	      </div>
	  </div>
	  <div class="g_9">
	      <!--<div class="n_bl_favorites">Следить</div>-->
	      <div class="n_bl_like"><div class="like_2"><svg class="like_1" xmlns="http://www.w3.org/2000/svg" viewBox="1248.229 4240.818 19.922 17.41">
  <g id="noun_1232905_cc" transform="translate(1248.229 4240.818)">
    <g id="Group_13" data-name="Group 13" transform="translate(0 0)">
      <path id="Path_6" data-name="Path 6" class="svg-like" d="M19.521,10c-.639,0-2.512,0-4.76,2.887C13.946,11.807,12.293,10,10,10a5.211,5.211,0,0,0-5.2,5.2,5.352,5.352,0,0,0,.375,1.961c.463,1.168,3.041,3.724,6.347,6.942,1.256,1.234,2.358,2.314,2.909,2.931l.331.375.331-.375c.551-.617,1.653-1.675,2.909-2.931,3.306-3.218,5.884-5.8,6.347-6.942a4.934,4.934,0,0,0,.375-1.961A5.211,5.211,0,0,0,19.521,10Zm4.011,6.832c-.441,1.08-3.746,4.3-6.149,6.655-1.058,1.036-2.005,1.961-2.623,2.6-.617-.639-1.565-1.565-2.623-2.6-2.4-2.358-5.708-5.576-6.149-6.655A4.128,4.128,0,0,1,5.682,15.2,4.326,4.326,0,0,1,10,10.882c2.028,0,3.482,1.7,4.408,3l.353.507.353-.507c.926-1.278,2.38-3,4.408-3A4.326,4.326,0,0,1,23.841,15.2,4.055,4.055,0,0,1,23.532,16.832Z" transform="translate(-4.8 -10)"/>
    </g>
  </g>
</svg></div><div class="like_3">123</div></div>
	  </div>
</div>
<?php \yii\widgets\Pjax::end() ?>