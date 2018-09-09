<?php
/**
 * Created by PhpStorm.
 * User: Dell Inspirion 3567
 * Date: 01.07.2018
 * Time: 20:07
 */

use yii\helpers\Url;

?>
<div class="news">
    <div class="n_bl">
        <div class="n_bl_1">
            <div class="n_bl_1_1"><a href="/profile"><img src="<?=($model->user->avatar)? '/web/img/uploads/'.$model->user->avatar:'/web/img/icon/nophoto.svg';?>" alt="" class="new_photo"></a></div>
            <div class="n_bl_1_4">
                <div class="n_bl_1_2"><a href="/profile"><?=$model->user->name?>&nbsp;<?=$model->user->surname?></a></div>
                <div class="n_bl_1_3"><?=Yii::$app->formatter->asDate($model->date_create)?></div>
            </div>

        </div>
        <div class="g_g11">
            <ul>
                <li><a href="<?=Url::toRoute(['news/delete','id'=>$model->id])?>">Удалить</a></li>
            </ul>
        </div>
        <div class="post_addgoal"><a href="<?=Url::toRoute(['goals/view','id'=>$model->goal->id])?>">
                <div class="post_addgoal_1"><img src="img/icon/newgoal.svg" alt=""></div>
                <div class="post_addgoal_6">Новая цель!</div>
                <div class="post_addgoal_2"><?=$model->goal->goal?></div>
                <div class="post_addgoal_3"><?=Yii::$app->formatter->asDate($model->goal->date_finish_goal)?> </div>
                <div class="post_addgoal_5">Посмотреть</div></a>
        </div>
    </div>
</div>
