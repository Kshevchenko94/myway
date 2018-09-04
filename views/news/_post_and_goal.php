<?php
/**
 * Created by PhpStorm.
 * User: Dell Inspirion 3567
 * Date: 01.07.2018
 * Time: 20:09
 */
use yii\helpers\Url;
?>
<div class="n_bl_1_6"><img src="/web/img/icon/next.png" alt=""></div>
<div class="n_bl_1_7"><a href="<?=Url::toRoute(['goals/view','id'=>$model->goal->id])?>">
        <div class="n_bl_1_8"><img src="/web/img/icon/newgoal.svg" alt=""></div>
        <div class="n_bl_1_11">
            <div class="n_bl_1_9"><?=$model->goal->goal?></div>
            <div class="n_bl_1_10">1 день</div>
        </div>
    </a></div>
