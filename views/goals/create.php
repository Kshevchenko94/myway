<?php

$this->title = 'Добавить новую цель';

?>

<div class="addgoal">
	<div class="g_h"><?=$this->title?></div>
	<?= $this->render('_form', ['model' => $model]) ?>
</div>