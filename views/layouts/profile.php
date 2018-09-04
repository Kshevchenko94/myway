<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="top_menu">
		<div class="top_menu_1">
			<div class="top_menu_2"><a href="/news">myway.space</a></div>
			<ul class="top_menu_3">
			    <li class="top_menu_4"><a href="/search">Люди</a></li>
				<li class="top_menu_4"><a href="/allgoals">Цели</a></li>
				<!--<li class="top_menu_4">Сoaching</li>
				<li class="top_menu_4">Education</li>-->
			</ul>
			
			<div class="top_menu_5" onclick="$('.top_menu_8').toggleClass('active');">
				<div class="top_menu_6"><?=Yii::$app->user->identity['name']?></div>
				<div class="top_menu_7"><img src="<?=(Yii::$app->user->identity['avatar'])? Url::to('/web/img/uploads/'.Yii::$app->user->identity['avatar']):Url::to('@web/img/icon/nophoto.svg');?>" alt="" class="profile"/></div>
				<div class="top_menu_8">
					<ul class="top_menu_9">
						<li class="top_menu_10"><a href="/profile">Моя страница</a></li>
						<li class="top_menu_10"><a href="<?=Url::toRoute(['profile/edit', 'section'=>'profile'])?>">Редактировать</a></li>
						<!--<li class="top_menu_10">Setting</li>
						<li class="top_menu_10">Help</li>-->
						<li class="top_menu_10"><a href="<?=Url::toRoute(['login/logout', 'id' => Yii::$app->user->identity['id']])?>">Выход</a></li>
					</ul>
				</div>
			</div>
			<!--<div class="top_menu_11"><img src="/web/img/icon/notification.svg" onclick="$('.top_menu_12').toggleClass('active');" alt=""/>
			<div class="top_menu_12">
				<ul>
					<li class="top_menu_13">
						Текст уведомления. 
						<div class="top_menu_14">13:29, 13 января</div>
					</li>
					<li class="top_menu_13">
						Текст уведомления. 
						<div class="top_menu_14">13:29, 13 января</div>
					</li>
					<li class="top_menu_13">
						Текст уведомления. 
						<div class="top_menu_14">13:29, 13 января</div>
					</li>
					<li class="top_menu_13">
						Текст уведомления. 
						<div class="top_menu_14">13:29, 13 января</div>
					</li>
				</ul>
			</div>-->
			</div>
		</div>
</div>
<div class="margin_index_profile">
<div class="margin_index_menu">
<div class="right_menu">
		<div class="rm_1">
		<ul class="rm_2">
	  	  <li class="rm_3"><a href="<?=Url::toRoute(['profile/index'])?>"><img src="/web/img/icon/home.svg" alt=""/><div class="rm_3_1">Моя страница</div></a></li>
	  	  <li class="rm_3"><a href="<?=Url::toRoute(['news/index'])?>"><img src="/web/img/icon/goals.svg" alt=""/><div class="rm_3_1">Новости</div></a></li>
		  <!--<li class="rm_3"><a href="/friends"><img src="/web/img/icon/friends.svg" alt=""/><div class="rm_3_1">Друзья</div></a></li>-->
		  <li class="rm_3"><a href="<?=Url::toRoute(['goals/index'])?>"><img src="/web/img/icon/news.svg" alt=""/><div class="rm_3_1">Мои цели</div></a></li>
		  <!--<li class="rm_3"><a href="/habits"><img src="/web/img/icon/goals.svg" alt=""/><div class="rm_3_1">Мои привычки</div></a></li>-->
		</ul>
		</div>
  	</div>
</div>
<div class="margin_index1">
    <?= $content ?>
</div>

</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>