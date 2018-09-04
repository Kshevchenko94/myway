<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "values".
 *
 * @property int $id
 * @property string $value
 * @property string $description
 * @property int $id_user
 * @property string $date_create
 *
 * @property Users $user
 */
class Values extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value', 'description', 'id_user', 'date_create'], 'required'],
            [['description'], 'string'],
            [['id_user'], 'integer'],
            [['date_create'], 'safe'],
            [['value'], 'string', 'max' => 255],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'Value',
            'description' => 'Description',
            'id_user' => 'Id User',
            'date_create' => 'Date Create',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'id_user']);
    }

    public function saveValue($post)
    {

        if($this->load($post))
        {
            $this->id_user = Yii::$app->user->id;
            $this->date_create = date("Y-m-d");
            return $this->save();
        }else{
            return false;
        }
    }
}
