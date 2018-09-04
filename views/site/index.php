<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Добро пожаловать.';
?>
<div class="login">
	<div class="login_1">
		<div class="login_2">myway.space</div>
		<div class="login_3">Социальная сеть для <br>постановки и достижения целей</div>
		<?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>
		<div class="login_5"><?= $form->field($model, 'username')->textInput() ?></div>
		<div class="login_5"><?= $form->field($model, 'password')->passwordInput() ?></div>
		<div class="login_6"><?= Html::submitButton('Войти', ['class' => 'button', 'name' => 'login-button']) ?></a></div>
		<?php ActiveForm::end(); ?>
		<div class="login_7"><a href="/registration">Создать аккаунт</a></div>
	</div>
</div>