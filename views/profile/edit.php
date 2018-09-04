<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Редактирование профиля';

$section = Yii::$app->request->get('section');

?>
<div class="margin_index1">
    <div class="e1 tab_container">
        <?php if (Yii::$app->session->hasFlash('dataEdited')): ?>

            <div class="alert alert-success">
                Все изменения успешно сохраненны.
            </div>

        <?php endif; ?>
        <div class="g_h">Редактирование профиля</div>
        <?php $form = ActiveForm::begin(); ?>
        <? if($section == 'profile') echo $this->render('sections/_profile.php', ['model'=>$model, 'form'=>$form]);?>
        <? if($section == 'contacts') echo $this->render('sections/_contacts.php', ['model'=>$model, 'form'=>$form])?>
        <? if($section == 'profession') echo $this->render('sections/_profession.php', ['model'=>$model, 'form'=>$form])?>
        <? if($section == 'skills') echo $this->render('sections/_skills.php', ['model'=>$model, 'form'=>$form])?>

        <? if($section == 'values') echo $this->render('sections/_values.php', ['values'=>$values, 'form'=>$form])?>

        <?php ActiveForm::end(); ?>
</div>
</div>
<div class="goal_menu_right margin_index2">
    <ul class="goal_menu_right_2 tabs">
        <li class="goal_menu_right_1"><a href="<?=Url::to(['profile/edit', 'section'=>'profile'])?>">Профиль</a></li>
        <li class="goal_menu_right_1"><a href="<?=Url::to(['profile/edit', 'section'=>'contacts'])?>">Контактная информация</a></li>
        <li class="goal_menu_right_1"><a href="<?=Url::to(['profile/edit', 'section'=>'profession'])?>">Профессия</a></li>
        <li class="goal_menu_right_1"><a href="<?=Url::to(['profile/edit', 'section'=>'skills'])?>">Навыки</a></li>
        <li class="goal_menu_right_1"><a href="<?=Url::to(['profile/edit', 'section'=>'values'])?>">Ценности</a></li>
    </ul>
</div>