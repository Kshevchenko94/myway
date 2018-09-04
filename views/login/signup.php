<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Регистрация.';
?>
<div class="login">
	<div class="login_1">
		<div class="login_2">myway.space</div>
		<div class="login_3">Социальная сеть для <br>постановки и достижения целей</div>
		<?php $form = ActiveForm::begin([
        'id' => 'signup-form',
        ]); ?>
		<div class="login_5"><?= $form->field($model, 'name')->textInput(['class'=>'input','placeholder'=>'Имя'])->label(false) ?></div>
		<div class="login_5"><?= $form->field($model, 'surname')->textInput(['class'=>'input','placeholder'=>'Фамилия'])->label(false) ?></div>
		<div class="login_5"><?= $form->field($model, 'email')->textInput(['class'=>'input','placeholder'=>'Почта'])->label(false) ?></div>
		<div class="login_5"><?= $form->field($model, 'password')->passwordInput(['class'=>'input','placeholder'=>'Пароль'])->label(false) ?></div>
		<div class="login_6"><?= Html::submitButton('Создать аккаунт', ['class' => 'button', 'name' => 'signup-button']) ?></a></div>
		<?php ActiveForm::end(); ?>
		<div class="login_7"><?= Html::a('Вернуться к входу',['login/login'])?></div>
	</div>
</div>