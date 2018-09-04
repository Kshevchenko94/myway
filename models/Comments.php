<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property string $text
 * @property string $date_create
 * @property int $id_user
 * @property int $id_element
 * @property string $section
 *
 * @property Users $user
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text', 'date_create', 'id_user', 'id_element', 'section'], 'required','message'=>'Поле обязательное для заполнения.', 'when' => function ($model) {
        return $model->text == '';}, 'whenClient' => "function (attribute, value) {return $('.news_comment').val() != '';}"],
            [['text'], 'string'],
            [['date_create'], 'safe'],
            [['id_user', 'id_element'], 'integer'],
            [['section'], 'string', 'max' => 255],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }
	
	public function getDateCreate()
    {
        return date('d.m.Y', $this->date_create);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'date_create' => 'Date Create',
            'id_user' => 'Id User',
            'id_element' => 'Id Element',
            'section' => 'Section',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'id_user']);
    }
}
