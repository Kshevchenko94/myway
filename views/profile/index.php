<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
$this->title = 'Профиль';

$this->registerJsFile('/js/profile.js',['depends' => [\yii\web\JqueryAsset::className()]]);

?>
<div class="pr margin_index2">
	<div class="pr_1">
		<div class="pr_3">
			<?php if(Yii::$app->user->identity['avatar']):?>
			<div class="pr_5"><img src="<?=Url::to('/web/img/uploads/'.Yii::$app->user->identity['avatar'], true)?>" alt=""/></div>
			<?php else:?>
			<div class="pr_5 edit"><img src="<?=Url::to('@web/img/icon/nophoto.svg', true)?>" alt=""></div>
			<?php endif;?>
			<div class="pr_6"><?=Yii::$app->user->identity['name'].' '.Yii::$app->user->identity['surname']?></div>
			<div class="pr_5_1"><?=(Yii::$app->user->identity['date_birth'])? Yii::$app->formatter->format(Yii::$app->user->identity['date_birth'],'date').' ('.\app\models\Profile::getAge(Yii::$app->user->identity['date_birth']).' лет)' :''?></div>
			<div class="pr_5_2"><?=(Yii::$app->user->identity['city_id'])? \app\models\Profile::getCity(Yii::$app->user->identity['city_id']) :''?></div>
			<!--<div class="button">добавить в друзья</div>-->
		</div>
	</div>
	<div class="pr_4">
			<div class="pr_4_h"><a href="<?=Url::to('/goals')?>">Цели</a><span class="pr_4_h2"><?=\app\models\Goals::getCountGoals()['count']?></span></div>
        <?php if($model->goals):?>
			<div class="pr_4_bar">
		<div class="bar">
            <table style="width:100%; text-align: center; color: #ffffff; font-weight: bold;">
                <tr style="height: 30px;">
                    <td style="width:<?=\app\models\Goals::getCountGoals(['status'=>2])['procent']?>%; background: #00CC99;"><?=\app\models\Goals::getCountGoals(['status'=>2])['count']?></td>
                    <td style="width:<?=\app\models\Goals::getCountGoals(['status'=>1])['procent']?>%; background: #FFCC33;"><?=\app\models\Goals::getCountGoals(['status'=>1])['count']?></td>
                    <td style="width:<?=\app\models\Goals::getCountGoals(['status'=>3])['procent']?>%; background: #FF6666;"><?=\app\models\Goals::getCountGoals(['status'=>3])['count']?></td>
                </tr>
            </table>
        </div>
	</div>

	<?php foreach($model->goals as $goal): ?>
			<div class="pr_4_b">
				<div class="pr_41_1"><div class="pr_41_2"><a href="<?=Url::to(['/goals/view/','id'=>$goal->id])?>"><?=$goal->goal?></a></div><div class="pr_41_l"><div class="n_bl_like"><div class="like_2"><svg class="like_1" xmlns="http://www.w3.org/2000/svg" viewBox="1248.229 4240.818 19.922 17.41">
  <g id="noun_1232905_cc" transform="translate(1248.229 4240.818)">
    <g id="Group_13" data-name="Group 13" transform="translate(0 0)">
      <path id="Path_6" data-name="Path 6" class="svg-like" d="M19.521,10c-.639,0-2.512,0-4.76,2.887C13.946,11.807,12.293,10,10,10a5.211,5.211,0,0,0-5.2,5.2,5.352,5.352,0,0,0,.375,1.961c.463,1.168,3.041,3.724,6.347,6.942,1.256,1.234,2.358,2.314,2.909,2.931l.331.375.331-.375c.551-.617,1.653-1.675,2.909-2.931,3.306-3.218,5.884-5.8,6.347-6.942a4.934,4.934,0,0,0,.375-1.961A5.211,5.211,0,0,0,19.521,10Zm4.011,6.832c-.441,1.08-3.746,4.3-6.149,6.655-1.058,1.036-2.005,1.961-2.623,2.6-.617-.639-1.565-1.565-2.623-2.6-2.4-2.358-5.708-5.576-6.149-6.655A4.128,4.128,0,0,1,5.682,15.2,4.326,4.326,0,0,1,10,10.882c2.028,0,3.482,1.7,4.408,3l.353.507.353-.507c.926-1.278,2.38-3,4.408-3A4.326,4.326,0,0,1,23.841,15.2,4.055,4.055,0,0,1,23.532,16.832Z" transform="translate(-4.8 -10)"></path>
    </g>
  </g>
</svg></div><div class="like_3">123</div></div></div></div>
				
			</div>
			<?php endforeach;?>
			<?php else:?>
				<div class="pr_4_b edit">
					<a href="<?=Url::to(['/goals/index/'])?>">Добавить цель</a>
				</div>
			<?php endif;?>
		</div>
	<?php if($model->values):
        \yii\widgets\Pjax::begin(['enablePushState'=>false, 'id'=>'values'])
        ?>
	<div class="pr_4">
			<div class="pr_4_h">Ценности</div>
			<ol class="pr_4_b">
			<?php foreach($model->values as $value): ?>
                <li>
                    <div class="col-lg-offset-8 ">
                        <?php
                            kartik\popover\PopoverX::begin([
                                'id'=>'valueId_'.$value->id,
                                'placement' => \kartik\popover\PopoverX::ALIGN_RIGHT,
                                'toggleButton' => ['label'=>'<span class="glyphicon glyphicon-pencil"></span>', 'tag'=>'a'],
                                'header' => 'Редактировать ценность',
                            ]);
                            $form = \yii\widgets\ActiveForm::begin(['action'=>Url::to(['values/update', 'id'=>$value->id])]);

                            echo $form->field($value, 'value')->textInput()->label(false);
                            echo $form->field($value, 'description')->textarea()->label(false);

                            echo \yii\helpers\Html::button('Сохранить', ['class'=>'btn btn-primary btn-block update_value']);

                            \yii\widgets\ActiveForm::end();
                        \kartik\popover\PopoverX::end();
                        ?>
                        <span data-del="<?=$value->id?>" class="glyphicon glyphicon-remove delete_value"></span>
                    </div>
                    <div class="pr_4_b_2"><?=$value->value?></div>
                    <div class="pr_4_b_3"><?=nl2br($value->description)?></div>

                </li>
			<?php endforeach;?>
			</ol>
	</div>

	<?php
        \yii\widgets\Pjax::end();
        endif;
	?>
</div>

<div class="margin_index1">
	
<div class="pr_2 profile_menu">
    <ul class="tabs">
        <li class="active"><a href="#tab1">Друзья (32)</a></li>
        <li><a href="#tab2">Информация</a></li>
    </ul>
</div>

	<ul class="pr_2 tab_container">
	    <ul id="tab1" class="pr2_1 tab_content" style="display: block;">
			<?php if($friends): ?>
			<div class="pr_4_b friends">
				<div class="pr_4_0"><a href="/profile">
					<div class="pr_4_1"><img src="/web/img/profile.jpg" alt=""></div>
					<div class="pr_4_2">Артем</div>
				</a></div>
				<div class="pr_4_0"><a href="/profile">
					<div class="pr_4_1"><img src="/web/img/profile.jpg" alt=""></div>
					<div class="pr_4_2">Артем</div>
				</a></div>
				<div class="pr_4_0"><a href="/profile">
					<div class="pr_4_1"><img src="/web/img/profile.jpg" alt=""></div>
					<div class="pr_4_2">Артем</div>
				</a></div>
				<div class="pr_4_0"><a href="/profile">
					<div class="pr_4_1"><img src="/web/img/profile.jpg" alt=""></div>
					<div class="pr_4_2">Артем</div>
				</a></div>
				<div class="pr_4_0"><a href="/profile">
					<div class="pr_4_1"><img src="/web/img/profile.jpg" alt=""></div>
					<div class="pr_4_2">Артем</div>
				</a></div>
				<div class="pr_4_0"><a href="/profile">
					<div class="pr_4_1"><img src="/web/img/profile.jpg" alt=""></div>
					<div class="pr_4_2">Артем</div>
				</a></div>
				<div class="pr_4_0"><a href="/profile">
					<div class="pr_4_1"><img src="/web/img/profile.jpg" alt=""></div>
					<div class="pr_4_2">Артем</div>
				</a></div>
			</div>
			<div class="pr_4_3"><a href="/friends">Все друзья</a></div>
			<?php else:?>
				<div class="pr_4_b edit">Нет друзей</div>
				<div class="pr_4_3"><a href="/<?=Url::to('search') ?>">Найти друзей</a></div>
			<?php endif;?>
		</ul>
	    <ul id="tab2" class="pr2_1 tab_content" style="display: none;">
		<?php if(Yii::$app->user->identity['telephone'] || Yii::$app->user->identity['vk'] || Yii::$app->user->identity['instagram'] || Yii::$app->user->identity['facebook'] || Yii::$app->user->identity['place_job'] || Yii::$app->user->identity['position'] || Yii::$app->user->identity['income'] || Yii::$app->user->identity['skills']):?>
	       <div class="pr2_5">
	           <div class="pr_2_h">Контакты</div>
	           <div class="pr_2_2">
	                <div class="pr2_3">Телефон:</div>
	                <div class="pr2_4"><?=(Yii::$app->user->identity['telephone'])? Yii::$app->user->identity['telephone']:''?></div>
	           </div>
	           <div class="pr_2_2">
	                <div class="pr2_3">VK</div>
	                <div class="pr2_4 link"><a href="<?=(Yii::$app->user->identity['vk'])? Yii::$app->user->identity['vk']:''?>"><?=(Yii::$app->user->identity['vk'])? Yii::$app->user->identity['vk']:''?></a></div>
	           </div>
	           <div class="pr_2_2">
	                <div class="pr2_3">Instagram</div>
	                <div class="pr2_4 link"><a href="<?=(Yii::$app->user->identity['instagram'])? Yii::$app->user->identity['instagram']:''?>"><?=(Yii::$app->user->identity['instagram'])? Yii::$app->user->identity['instagram']:''?></a></div>
	           </div>
	           <div class="pr_2_2">
	                <div class="pr2_3">Facebook</div>
	                <div class="pr2_4 link"><a href="<?=(Yii::$app->user->identity['facebook'])? Yii::$app->user->identity['facebook']:''?>"><?=(Yii::$app->user->identity['facebook'])? Yii::$app->user->identity['facebook']:''?></a></div>
	           </div>
	       </div>
	       <div class="pr2_5">
	           <div class="pr_2_h">Профессия</div>
	           <div class="pr_2_2">
	                <div class="pr2_3">Место работы:</div>
	                <div class="pr2_4"><?=(Yii::$app->user->identity['place_job'])? Yii::$app->user->identity['place_job']:''?></div>
	           </div>
	           <div class="pr_2_2">
	                <div class="pr2_3">Должность:</div>
	                <div class="pr2_4"><?=(Yii::$app->user->identity['position'])? Yii::$app->user->identity['position']:''?></div>
	           </div>
	           <div class="pr_2_2">
	                <div class="pr2_3">Доход в год:</div>
	                <div class="pr2_4"><?=(Yii::$app->user->identity['income'])? Yii::$app->user->identity['income']:''?></div>
	           </div>
	       </div>
	       <div class="pr2_5">
	           <div class="pr_2_h">Навыки и увлечения</div>
	           <div class="pr_2_2">
	                <div class="pr2_3">Навыки</div>
	                <div class="pr2_4"><?=(Yii::$app->user->identity['skills'])? Yii::$app->user->identity['skills']:''?></div>
	           </div>
	       </div>
		   <?php else:?>
			<div class="pr2_5 edit"><a href="<?=Url::to(['/profile/edit/','section'=>'contacts'])?>">Добавить информацию</a></div>
		   <?php endif;?>
	</ul>
	
		<div class="add_news">
	<div class="add_news_1"><textarea type="text" placeholder="Добавить запись…" class="add_news_text"></textarea></div>
	<div class="post_add_goal_2">Пост к цели: <span>Купить вертолет не дешевле 2 млн</span><label>x</label></div>
    <div class="add_news_2">
        <div type="image" class="addphoto"><img src="img/icon/addphoto.svg"></div>
        <div type="image" class="addphoto addgoal" onclick="$('#idpost').toggleClass('active');"><img src="img/icon/flag.svg"></div>
        <div class="post_add_goal" id="idpost">
                <ul>
                    <div class="post_add_goal_1">К какой цели пишем пост?</div>
                    <li>Купить вертолет</li>
                    <li>Купить вертолет</li>
                    <li>Купить вертолет</li>
                    <li>Купить вертолет</li>
                    <li>Купить вертолет</li>
                    <li>Купить вертолет</li>
                    <li>Купить вертолет</li>
                </ul>
        </div>
        
    </div>
    <div class="add_news_3"><button class="button">добавить</button></div>
</div>
		<div class="wall_filter">
	    <ul>
	        <li class="active">Все записи</li>
	        <li>Записи по целям</li>
	        <li>Обычные записи</li>
	    </ul>
	</div>
		<div class="news">
	<div class="n_bl">
		<div class="n_bl_1">
			<div class="n_bl_1_1"><a href="/profile"><img src="img/profile.jpg" alt="" class="new_photo"></a></div>
			<div class="n_bl_1_4">	
				<div class="n_bl_1_2"><a href="/profile">Артем Афонин</a></div>
				<div class="n_bl_1_3">12 сентября в 15:43</div>
			</div>
			<div class="n_bl_1_6"><img src="/img/icon/next.png" alt=""></div>
			<div class="n_bl_1_7"><a href="/goal1-1">
			    <div class="n_bl_1_8"><img src="img/icon/newgoal.svg" alt=""></div>
			    <div class="n_bl_1_11">
			        <div class="n_bl_1_9">Купить новый вертолет до нового года. Не дешевле 2 млн.</div>
			        <div class="n_bl_1_10">1 день</div>
			    </div>
			</a></div>
		</div>
		<div class="g_g10"><div class="n_bl_1_5" onclick="$('.g_g11').toggleClass('active');"><img src="img/icon/points.svg" alt=""></div>
        <div class="g_g11">
            <ul>
                <li>Редактировать</li>
                <li>Удалить</li>
            </ul>
        </div>
        </div>
		<div class="n_bl_2">
		За последние несколько лет в моей голове сложилась картина отношений, которые я хочу со своей девушкой. <br>За последние несколько лет в моей
		<div class="new_button_all" onclick="$('#id').toggleClass('active');">Показать подробнее</div>
		<span id="id" class="all_post">За последние несколько лет в моей голове сложилась картина отношений, которые я хочу со своей девушкой. <br>За последние несколько лет в моей</span>	
		</div>
		<div class="n_bl_3"><img src="img/posd.jpg" width="697" height="156"></div>
		<div class="n_bl_4">
			<div class="n_bl_comment">
				<input type="text" placeholder="Напишите комментарий..." class="news_comment">
				<button class="button_news"></button>
			</div>
			<div class="n_bl_like active"><div class="like_2"><svg class="like_1" xmlns="http://www.w3.org/2000/svg" viewBox="1248.229 4240.818 19.922 17.41">
  <g id="noun_1232905_cc" transform="translate(1248.229 4240.818)">
    <g id="Group_13" data-name="Group 13" transform="translate(0 0)">
      <path id="Path_6" data-name="Path 6" class="svg-like" d="M19.521,10c-.639,0-2.512,0-4.76,2.887C13.946,11.807,12.293,10,10,10a5.211,5.211,0,0,0-5.2,5.2,5.352,5.352,0,0,0,.375,1.961c.463,1.168,3.041,3.724,6.347,6.942,1.256,1.234,2.358,2.314,2.909,2.931l.331.375.331-.375c.551-.617,1.653-1.675,2.909-2.931,3.306-3.218,5.884-5.8,6.347-6.942a4.934,4.934,0,0,0,.375-1.961A5.211,5.211,0,0,0,19.521,10Zm4.011,6.832c-.441,1.08-3.746,4.3-6.149,6.655-1.058,1.036-2.005,1.961-2.623,2.6-.617-.639-1.565-1.565-2.623-2.6-2.4-2.358-5.708-5.576-6.149-6.655A4.128,4.128,0,0,1,5.682,15.2,4.326,4.326,0,0,1,10,10.882c2.028,0,3.482,1.7,4.408,3l.353.507.353-.507c.926-1.278,2.38-3,4.408-3A4.326,4.326,0,0,1,23.841,15.2,4.055,4.055,0,0,1,23.532,16.832Z" transform="translate(-4.8 -10)"></path>
    </g>
  </g>
</svg></div><div class="like_3">123</div></div>
		</div>
		<div class="n_bl_5">
		    <div class="n_bl_5_1">
		        <div class="n_bl_5_7">x</div>
		        <div class="n_bl_5_2"><img src="img/profile.jpg" alt=""></div>
		        <div class="n_bl_5_3">
		            <div class="n_bl_5_4">Артем Афонин</div>
		            <div class="n_bl_5_5">12 января 2017 в 12:43</div>
		            <div class="n_bl_5_6">тут текст тут текст тут текст тут текст тут текст тут текст тут текст тут текст тут текст тут текст тут текст тут текст тут текст тут текст тут текст тут текст тут текст тут текст тут текст тут текст тут текст </div>
                    <div class="n_bl_like active"><div class="like_2"><svg class="like_1" xmlns="http://www.w3.org/2000/svg" viewBox="1248.229 4240.818 19.922 17.41">
  <g id="noun_1232905_cc" transform="translate(1248.229 4240.818)">
    <g id="Group_13" data-name="Group 13" transform="translate(0 0)">
      <path id="Path_6" data-name="Path 6" class="svg-like" d="M19.521,10c-.639,0-2.512,0-4.76,2.887C13.946,11.807,12.293,10,10,10a5.211,5.211,0,0,0-5.2,5.2,5.352,5.352,0,0,0,.375,1.961c.463,1.168,3.041,3.724,6.347,6.942,1.256,1.234,2.358,2.314,2.909,2.931l.331.375.331-.375c.551-.617,1.653-1.675,2.909-2.931,3.306-3.218,5.884-5.8,6.347-6.942a4.934,4.934,0,0,0,.375-1.961A5.211,5.211,0,0,0,19.521,10Zm4.011,6.832c-.441,1.08-3.746,4.3-6.149,6.655-1.058,1.036-2.005,1.961-2.623,2.6-.617-.639-1.565-1.565-2.623-2.6-2.4-2.358-5.708-5.576-6.149-6.655A4.128,4.128,0,0,1,5.682,15.2,4.326,4.326,0,0,1,10,10.882c2.028,0,3.482,1.7,4.408,3l.353.507.353-.507c.926-1.278,2.38-3,4.408-3A4.326,4.326,0,0,1,23.841,15.2,4.055,4.055,0,0,1,23.532,16.832Z" transform="translate(-4.8 -10)"></path>
    </g>
  </g>
</svg></div><div class="like_3">123</div></div>
                </div>
		    </div>
		    <div class="n_bl_5_1">
		        <div class="n_bl_5_7">x</div>
		        <div class="n_bl_5_2"><img src="img/profile.jpg" alt=""></div>
		        <div class="n_bl_5_3">
		            <div class="n_bl_5_4">Артем Афонин</div>
		            <div class="n_bl_5_5">12 января 2017 в 12:43</div>
		            <div class="n_bl_5_6">тут текст тут текст тут текст тут текст тут текст тут текст тут текст </div>
		          <div class="n_bl_like active"><div class="like_2"><svg class="like_1" xmlns="http://www.w3.org/2000/svg" viewBox="1248.229 4240.818 19.922 17.41">
  <g id="noun_1232905_cc" transform="translate(1248.229 4240.818)">
    <g id="Group_13" data-name="Group 13" transform="translate(0 0)">
      <path id="Path_6" data-name="Path 6" class="svg-like" d="M19.521,10c-.639,0-2.512,0-4.76,2.887C13.946,11.807,12.293,10,10,10a5.211,5.211,0,0,0-5.2,5.2,5.352,5.352,0,0,0,.375,1.961c.463,1.168,3.041,3.724,6.347,6.942,1.256,1.234,2.358,2.314,2.909,2.931l.331.375.331-.375c.551-.617,1.653-1.675,2.909-2.931,3.306-3.218,5.884-5.8,6.347-6.942a4.934,4.934,0,0,0,.375-1.961A5.211,5.211,0,0,0,19.521,10Zm4.011,6.832c-.441,1.08-3.746,4.3-6.149,6.655-1.058,1.036-2.005,1.961-2.623,2.6-.617-.639-1.565-1.565-2.623-2.6-2.4-2.358-5.708-5.576-6.149-6.655A4.128,4.128,0,0,1,5.682,15.2,4.326,4.326,0,0,1,10,10.882c2.028,0,3.482,1.7,4.408,3l.353.507.353-.507c.926-1.278,2.38-3,4.408-3A4.326,4.326,0,0,1,23.841,15.2,4.055,4.055,0,0,1,23.532,16.832Z" transform="translate(-4.8 -10)"></path>
    </g>
  </g>
</svg></div><div class="like_3">123</div></div>
                </div>
		    </div>
		    <div class="n_bl_5_1">
		        <div class="n_bl_5_7">x</div>
		        <div class="n_bl_5_2"><img src="img/profile.jpg" alt=""></div>
		        <div class="n_bl_5_3">
		            <div class="n_bl_5_4">Артем Афонин</div>
		            <div class="n_bl_5_5">12 января 2017 в 12:43</div>
		            <div class="n_bl_5_6">тут текст тут текст тут текст тут текст тут текст тут текст тут текст </div>
		          <div class="n_bl_like active"><div class="like_2"><svg class="like_1" xmlns="http://www.w3.org/2000/svg" viewBox="1248.229 4240.818 19.922 17.41">
  <g id="noun_1232905_cc" transform="translate(1248.229 4240.818)">
    <g id="Group_13" data-name="Group 13" transform="translate(0 0)">
      <path id="Path_6" data-name="Path 6" class="svg-like" d="M19.521,10c-.639,0-2.512,0-4.76,2.887C13.946,11.807,12.293,10,10,10a5.211,5.211,0,0,0-5.2,5.2,5.352,5.352,0,0,0,.375,1.961c.463,1.168,3.041,3.724,6.347,6.942,1.256,1.234,2.358,2.314,2.909,2.931l.331.375.331-.375c.551-.617,1.653-1.675,2.909-2.931,3.306-3.218,5.884-5.8,6.347-6.942a4.934,4.934,0,0,0,.375-1.961A5.211,5.211,0,0,0,19.521,10Zm4.011,6.832c-.441,1.08-3.746,4.3-6.149,6.655-1.058,1.036-2.005,1.961-2.623,2.6-.617-.639-1.565-1.565-2.623-2.6-2.4-2.358-5.708-5.576-6.149-6.655A4.128,4.128,0,0,1,5.682,15.2,4.326,4.326,0,0,1,10,10.882c2.028,0,3.482,1.7,4.408,3l.353.507.353-.507c.926-1.278,2.38-3,4.408-3A4.326,4.326,0,0,1,23.841,15.2,4.055,4.055,0,0,1,23.532,16.832Z" transform="translate(-4.8 -10)"></path>
    </g>
  </g>
</svg></div><div class="like_3">123</div></div>
                </div>
		    </div>
		    
		</div>
	</div>
</div>
		
<div class="news">
	<div class="n_bl">
		<div class="n_bl_1">
			<div class="n_bl_1_1"><a href="/habit1"><img src="img/profile.jpg" alt="" class="new_photo"></a></div>
			<div class="n_bl_1_4">	
				<div class="n_bl_1_2"><a href="/habit1">Артем Афонин</a></div>
				<div class="n_bl_1_3">12 сентября в 15:43</div>
			</div>
		</div>
		<div class="g_g10"><div class="n_bl_1_5" onclick="$('.g_g11').toggleClass('active');"><img src="img/icon/points.svg" alt=""></div>
        <div class="g_g11">
            <ul>
                <li>Редактировать</li>
                <li>Удалить</li>
            </ul>
        </div>
        </div>
		<div class="n_bl_2">
		    <div class="post_addgoal"><a href="/habit1">
		    <div class="post_addgoal_1"><img src="img/icon/newgoal.svg" alt=""></div>
		    <div class="post_addgoal_6">Новая привычка!</div>
		    <div class="post_addgoal_2">Вставать в 6 утра</div>
		    <div class="post_addgoal_3"></div>
		    <div class="post_addgoal_5">Посмотреть</div></a>
		    </div>
        </div>
		<!--<div class="n_bl_4">
			<div class="n_bl_comment">
				<input type="text" placeholder="Напишите комментарий..." class="news_comment">
				<button class="button_news"></button>
			</div>
			<div class="n_bl_like">123</div>
			<div class="n_bl_share">5</div>
		</div>-->
	</div>
</div>
		
<div class="news">
	<div class="n_bl">
		<div class="n_bl_1">
			<div class="n_bl_1_1"><a href="/profile"><img src="img/profile.jpg" alt="" class="new_photo"></a></div>
			<div class="n_bl_1_4">	
				<div class="n_bl_1_2"><a href="/profile">Артем Афонин</a></div>
				<div class="n_bl_1_3">12 сентября в 15:43</div>
			</div>
		</div>
		<div class="g_g10"><div class="n_bl_1_5" onclick="$('.g_g11').toggleClass('active');"><img src="img/icon/points.svg" alt=""></div>
        <div class="g_g11">
            <ul>
                <li>Редактировать</li>
                <li>Удалить</li>
            </ul>
        </div>
        </div>
		<div class="n_bl_2">
		    <div class="post_addgoal"><a href="/goal1-1">
		    <div class="post_addgoal_1"><img src="img/icon/newgoal.svg" alt=""></div>
		    <div class="post_addgoal_6">Новая цель!</div>
		    <div class="post_addgoal_2">купить вертолет</div>
		    <div class="post_addgoal_3">до 21 января 2018 </div>
		    <div class="post_addgoal_5">Посмотреть</div></a>
		    </div>
        </div>
		<!--<div class="n_bl_4">
			<div class="n_bl_comment">
				<input type="text" placeholder="Напишите комментарий..." class="news_comment">
				<button class="button_news"></button>
			</div>
			<div class="n_bl_like">123</div>
			<div class="n_bl_share">5</div>
		</div>-->
	</div>
</div>

		<div class="news">
	<div class="n_bl">
		<div class="n_bl_1">
			<div class="n_bl_1_1"><a href="/profile"><img src="img/profile.jpg" alt="" class="new_photo"></a></div>
			<div class="n_bl_1_4">	
				<div class="n_bl_1_2"><a href="/profile">Артем Афонин</a></div>
				<div class="n_bl_1_3">12 сентября в 15:43</div>
			</div>
		</div>
		<div class="g_g10"><div class="n_bl_1_5" onclick="$('.g_g11').toggleClass('active');"><img src="img/icon/points.svg" alt=""></div>
        <div class="g_g11">
            <ul>
                <li>Редактировать</li>
                <li>Удалить</li>
            </ul>
        </div>
        </div>
		
		<div class="n_bl_2">
		За последние несколько лет в моей голове сложилась картина отношений, которые я хочу со своей девушкой. <br>За последние несколько лет в моей
		<div class="new_button_all" onclick="$('#id').toggleClass('active');">Показать подробнее</div>
		<span id="id" class="all_post">За последние несколько лет в моей голове сложилась картина отношений, которые я хочу со своей девушкой. <br>За последние несколько лет в моей</span>	
		</div>
		<div class="n_bl_3"><img src="img/posd.jpg" width="697" height="156"></div>
		<div class="n_bl_4">
			<div class="n_bl_comment">
				<input type="text" placeholder="Напишите комментарий..." class="news_comment">
				<button class="button_news"></button>
			</div>
			<div class="n_bl_like"><div class="like_2"><svg class="like_1" xmlns="http://www.w3.org/2000/svg" viewBox="1248.229 4240.818 19.922 17.41">
  <g id="noun_1232905_cc" transform="translate(1248.229 4240.818)">
    <g id="Group_13" data-name="Group 13" transform="translate(0 0)">
      <path id="Path_6" data-name="Path 6" class="svg-like" d="M19.521,10c-.639,0-2.512,0-4.76,2.887C13.946,11.807,12.293,10,10,10a5.211,5.211,0,0,0-5.2,5.2,5.352,5.352,0,0,0,.375,1.961c.463,1.168,3.041,3.724,6.347,6.942,1.256,1.234,2.358,2.314,2.909,2.931l.331.375.331-.375c.551-.617,1.653-1.675,2.909-2.931,3.306-3.218,5.884-5.8,6.347-6.942a4.934,4.934,0,0,0,.375-1.961A5.211,5.211,0,0,0,19.521,10Zm4.011,6.832c-.441,1.08-3.746,4.3-6.149,6.655-1.058,1.036-2.005,1.961-2.623,2.6-.617-.639-1.565-1.565-2.623-2.6-2.4-2.358-5.708-5.576-6.149-6.655A4.128,4.128,0,0,1,5.682,15.2,4.326,4.326,0,0,1,10,10.882c2.028,0,3.482,1.7,4.408,3l.353.507.353-.507c.926-1.278,2.38-3,4.408-3A4.326,4.326,0,0,1,23.841,15.2,4.055,4.055,0,0,1,23.532,16.832Z" transform="translate(-4.8 -10)"></path>
    </g>
  </g>
</svg></div><div class="like_3">123</div></div>
		</div>
	</div>
</div>

	</ul>
	
</div>
