<?php

$this->title = 'Добавить новую цель';

/* @var $stages app\models\Stages */
/* @var $subStages app\models\Substage */


?>

<div class="addgoal">
	<div class="g_h"><?=$this->title?></div>
	<?= $this->render('_form', ['model' => $model, 'stages'=>$stages, 'subStages'=>$subStages]) ?>
</div>