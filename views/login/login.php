<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Добро пожаловать.';
?>
<div class="login">
	<div class="login_1">
		<div class="login_2">myway.space</div>
		<div class="login_3">Социальная сеть для <br>постановки и достижения целей</div>
		<?php if(Yii::$app->session->hasFlash('signed')):?>
			<div class="alert alert-success">
				Ура, вы зарегистрированы.
			</div>
		<?php endif;?>
		<?php $form = ActiveForm::begin([
        'id' => 'login-form',
        ]); ?>
		<div class="login_5"><?= $form->field($model, 'email')->textInput(['class'=>'input','placeholder'=>'Почта'])->label(false) ?></div>
		<div class="login_5"><?= $form->field($model, 'password')->passwordInput(['class'=>'input','placeholder'=>'Пароль'])->label(false) ?></div>
		<div class="login_6"><?= Html::submitButton('Войти', ['class' => 'button', 'name' => 'login-button']) ?></a></div>
		<?php ActiveForm::end(); ?>
		
		<div class="login_7"><?= Html::a('Создать аккаунт',['login/signup'])?></div>
	</div>
</div>