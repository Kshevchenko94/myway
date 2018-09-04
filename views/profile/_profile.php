<?php

use yii\helpers\Url;

?>
<div class="f_1">
        <div class="f_2">
            <a href="/profile">
                <div class="f_3"><img src="<?=($model->avatar)?Url::to('@web/img/avatars/'.$model->avatar, true):Url::to('@web/img/icon/nophoto.svg', true);?>" alt=""></div>
                <div class="f_6">
                    <div class="f_4"><?=$model->name.' '.$model->surname?></div>
                    <div class="f_5"><?=($model->status)?'Онлайн':'';?></div>
                </div>
                <div class="f_10"><div class="button">добавить</div></div>
            </a>
        </div>
    </div>
