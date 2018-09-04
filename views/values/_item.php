<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ValuesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<table border="1">
	<tr>
		<td><?=$model->id?></td>
		<td><?=$model->value?></td>
		<td><?=nl2br($model->description)?></td>
		<td><?=$model->date_create?></td>
		<td></td>
	</tr>
</table>
