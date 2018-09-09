<?php

use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\helpers\Html;
?>
<div class="news" id="news_<?=$model->id?>" data-id-element="<?=$model->id?>">
    <div class="n_bl">
        <div class="n_bl_1">
            <div class="n_bl_1_1"><a href="/profile"><img src="<?=($model->user->avatar)? '/web/img/uploads/'.$model->user->avatar:'/web/img/icon/nophoto.svg';?>" alt="" class="new_photo"></a></div>
            <div class="n_bl_1_4">
                <div class="n_bl_1_2"><a href="/profile"><?=$model->user->name?>&nbsp;<?=$model->user->surname?></a></div>
                <div class="n_bl_1_3"><?=Yii::$app->formatter->asDatetime($model->date_create)?></div>
            </div>
            <?php if($model->text && $model->id_goal && !$model->section):?>
                <?=$this->render('_post_and_goal',['model'=>$model])?>
            <?php endif;?>
        </div>
        <div class="g_g10"><div class="n_bl_1_5" onclick="$('.g_g11').toggleClass('active');"><img src="/web/img/icon/points.svg" alt=""></div>
            <div>
                <ul>
                    <li>
                        <?php
                        Modal::begin([
                            'toggleButton' => ['label' => 'Редактировать', 'tag'=>'a'],
                            'closeButton'=>false,
                            'id' => 'update_modal_'.$model->id,
                            'options'=>['class'=>['modal_update_news']],
                        ]);
                        echo $this->render('update',['model'=>$model]);
                        Modal::end();


                        ?>
                    </li>
                    <li><?=Html::Button('Удалить', ['class' => 'del_news btn btn-default'])?></li>
                </ul>
            </div>
        </div>
        <div class="n_bl_2">
            <?=Yii::$app->formatter->asNtext($model->text)?>
        </div>
        <?php if($model->file): ?>
            <div class="n_bl_3"><a data-lightbox="<?=$model->file?>" href="<?=Url::to('/web/img/uploads/'.$model->file)?>" width="697" height="156"><?=Html::img(Url::to('/web/img/uploads/'.$model->file))?></a></div>
        <?php endif; ?>
        <div class="n_bl_4">
            <div class="n_bl_comment">
                <?php echo \Yii::$app->view->renderFile('@app/views/comments/_form.php',['model'=>new \app\models\Comments(),'id_element'=>$model->id,'section'=>'news']);?>

            </div>
            <div class="n_bl_like"><div class="like_2"><svg class="like_1" xmlns="http://www.w3.org/2000/svg" viewBox="1248.229 4240.818 19.922 17.41">
                        <g id="noun_1232905_cc" transform="translate(1248.229 4240.818)">
                            <g id="Group_13" data-name="Group 13" transform="translate(0 0)">
                                <path id="Path_6" data-name="Path 6" class="svg-like" d="M19.521,10c-.639,0-2.512,0-4.76,2.887C13.946,11.807,12.293,10,10,10a5.211,5.211,0,0,0-5.2,5.2,5.352,5.352,0,0,0,.375,1.961c.463,1.168,3.041,3.724,6.347,6.942,1.256,1.234,2.358,2.314,2.909,2.931l.331.375.331-.375c.551-.617,1.653-1.675,2.909-2.931,3.306-3.218,5.884-5.8,6.347-6.942a4.934,4.934,0,0,0,.375-1.961A5.211,5.211,0,0,0,19.521,10Zm4.011,6.832c-.441,1.08-3.746,4.3-6.149,6.655-1.058,1.036-2.005,1.961-2.623,2.6-.617-.639-1.565-1.565-2.623-2.6-2.4-2.358-5.708-5.576-6.149-6.655A4.128,4.128,0,0,1,5.682,15.2,4.326,4.326,0,0,1,10,10.882c2.028,0,3.482,1.7,4.408,3l.353.507.353-.507c.926-1.278,2.38-3,4.408-3A4.326,4.326,0,0,1,23.841,15.2,4.055,4.055,0,0,1,23.532,16.832Z" transform="translate(-4.8 -10)"/>
                            </g>
                        </g>
                    </svg></div><div class="like_3">123</div></div>
        </div>
        <?php foreach($model->comments as $comment):?>
            <div class="n_bl_5">
                <div class="n_bl_5_1">
                    <div class="n_bl_5_7">x</div>
                    <div class="n_bl_5_2"><img src="/web/img/avatars/<?=($comment->user->avatar)? $comment->user->avatar:'no_avatar.jpg';?>" alt="" class="new_photo"></div>
                    <div class="n_bl_5_3">
                        <div class="n_bl_5_4"><?=$comment->user->name?>&nbsp;<?=$comment->user->surname?></div>
                        <div class="n_bl_5_5"><?=$comment['date_create']?></div>
                        <div class="n_bl_5_6"><?=$comment['text']?></div>
                        <div class="n_bl_like active"><div class="like_2"><svg class="like_1" xmlns="http://www.w3.org/2000/svg" viewBox="1248.229 4240.818 19.922 17.41">
                                    <g id="noun_1232905_cc" transform="translate(1248.229 4240.818)">
                                        <g id="Group_13" data-name="Group 13" transform="translate(0 0)">
                                            <path id="Path_6" data-name="Path 6" class="svg-like" d="M19.521,10c-.639,0-2.512,0-4.76,2.887C13.946,11.807,12.293,10,10,10a5.211,5.211,0,0,0-5.2,5.2,5.352,5.352,0,0,0,.375,1.961c.463,1.168,3.041,3.724,6.347,6.942,1.256,1.234,2.358,2.314,2.909,2.931l.331.375.331-.375c.551-.617,1.653-1.675,2.909-2.931,3.306-3.218,5.884-5.8,6.347-6.942a4.934,4.934,0,0,0,.375-1.961A5.211,5.211,0,0,0,19.521,10Zm4.011,6.832c-.441,1.08-3.746,4.3-6.149,6.655-1.058,1.036-2.005,1.961-2.623,2.6-.617-.639-1.565-1.565-2.623-2.6-2.4-2.358-5.708-5.576-6.149-6.655A4.128,4.128,0,0,1,5.682,15.2,4.326,4.326,0,0,1,10,10.882c2.028,0,3.482,1.7,4.408,3l.353.507.353-.507c.926-1.278,2.38-3,4.408-3A4.326,4.326,0,0,1,23.841,15.2,4.055,4.055,0,0,1,23.532,16.832Z" transform="translate(-4.8 -10)"></path>
                                        </g>
                                    </g>
                                </svg></div><div class="like_3">123</div></div>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>

</div>
