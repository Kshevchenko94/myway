<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<div class="g_g10"><div class="n_bl_1_5" onclick="$(this).parent().find('.g_g11').toggleClass('active');"><img src="/web/img/icon/points.svg" alt=""></div>
    <div class="g_g11">
        <ul>
            <?php if($model->status == 1):?>

                <?php
                \kartik\popover\PopoverX::begin([
                    'id'=>'goalsPopover'.$model->id,
                    'placement' => \kartik\popover\PopoverX::ALIGN_RIGHT,
                    'toggleButton' => ['label'=>'<li>Завершить цель</li>', 'tag'=>'a'],
                    'header' => 'Завершить цель',
                ])
                ?>
                <?= Html::button('Выполненное', ['class' => 'btn btn-success closed_goal', 'data-status'=>'2', 'data-id'=>$model->id]) ?>
                <?= Html::button('Проваленное', ['class' => 'btn btn-danger closed_goal', 'data-status'=>'3', 'data-id'=>$model->id]) ?>
                <?php kartik\popover\PopoverX::end()?>
            <?php endif; ?>
            <li><a href="<?=Url::to(['goals/view','id'=>$model->id])?>">Просмотр цели</a></li>
            <li><a href="<?=Url::to(['goals/update','id'=>$model->id])?>">Редактировать</a></li>
            <li><a href="<?=Url::to(['goals/delete','id'=>$model->id])?>">Удалить</a></li>
        </ul>
    </div>
</div>