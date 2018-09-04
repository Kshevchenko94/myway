
<div>
    <div class="ag_3">План достижения цели</div>
    <div class="container_plan">
<?=$form->field($stages, 'stages')->widget(\unclead\multipleinput\MultipleInput::className(),
    [
        'min'=>0,
        'id'=>'multiple-input',
        'rendererClass' => \unclead\multipleinput\renderers\ListRenderer::className(),
        'addButtonPosition'=>\unclead\multipleinput\MultipleInput::POS_FOOTER,
        'addButtonOptions'=>(!$update)?['class'=>'ag_2_1', 'label'=>'Добавить этап']:[],
        'layoutConfig'=>['offsetClass'=>'','labelClass'=>''],
        'rowOptions' => function($model) {
            $options = [];

        if (!$model['id']) {
            $options['class'] = 'new_stage';
        }else{
            $options['data-stageId'] = $model['id'];
        }
        return $options;
    },
    'columns' => [
        [
            'name'=>'title',
            'options'=>[
                'class'=>'input_goal'
            ]
        ],
        [
            'name'=>'description',
            'type'=>'textarea',
            'options'=>[
                'class'=>'input_goal'
            ]
        ],
        [
            'name'=>'date_finish_stage',
            'type'=>\kartik\date\DatePicker::className(),
            'options'=>[
                'layout'=>'{input}{remove}',
            ]
        ],
        /*[
            'name'=>'Substage',
            'type'=>\unclead\multipleinput\MultipleInput::className(),
            'options'=>[
                'columns'=>[
                    [
                        'name'=>'text',
                        'options'=>[
                            'class'=>'input_goal'
                        ]
                    ]
                ]
            ]
        ],*/
    ]
])->label(false);
if($update)
{
    echo \yii\helpers\Html::button('Добавить этап',['class'=>'btn btn-block btn-primary update_stages_goal']);
}
?>
    </div>
</div>
