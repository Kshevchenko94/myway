<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новости';
\yii\widgets\Pjax::begin(['id'=>'pjax_news', 'enablePushState'=>false]);
?>

<?= $this->render('_form', ['model' => $model]) ?>
<?php
try {
    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_list',
        'summary' => false,
    ]);
} catch (Exception $e) {
}
\yii\widgets\Pjax::end();
?>
