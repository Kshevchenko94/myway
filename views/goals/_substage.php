<?php


?>
<?php foreach($Substages as $key2=>$substage):?>
    <div class="container_substage">
        <div class="substage">
            <div class="ag_1_3"><?=$form->field($substage, "[$key][$key2]substages")->textInput(['placeholder'=>'Подэтап цели','class'=>'input_goal'])->label(false);?></div>

        </div>
    </div>
<?php endforeach;?>
<div class="ag_1_3 add_plan_items">Добавить</div>