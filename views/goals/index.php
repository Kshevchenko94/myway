<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\GoalsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мои цели';

$this->registerJsFile('/js/goals.js',['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="return"><a href="/profile">вернуться к моей странице</a></div>

	<div class="goal margin_index1">
		<div class="goal_menu_button button"><?= Html::a('Добавить цель', ['create']) ?></div>
        <?php Pjax::begin(['id'=>'list_goals']); ?>
		<?= ListView::widget([
			'dataProvider' => $dataProvider,
			'itemView' => '_list',
			'layout'=>"<div class='g_h'>$this->title<span>({summary})</span></div>\n{items}\n{pager}",
			'summary' => '{totalCount}',
			'emptyText' => '<h1 style="margin:50px 0; text-align:center;">Целий пока у вас нет.</h1>',
			
			
		]) ?>
        <?php Pjax::end(); ?>
	</div>

	<div class="goal_menu_right">
		<?php echo $this->render('_search', ['model' => $searchModel]); ?>
	</div>

