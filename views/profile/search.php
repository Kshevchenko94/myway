<?php
$this->title = 'Поиск людей';

use yii\widgets\ListView;
?>
<div class="margin_index1">
<div class="friends_index">
    <div class="g_h">Поиск людей</div>
    <div class="f_11">
        <div class="f_12"><input type="text" placeholder="Поиск..."></div>
    </div>
	<?php
	echo ListView::widget([
		'dataProvider' => $dataProvider,
		'itemView' => '_profile',
		'summary' => false,
	]);
	?>
</div>
</div>