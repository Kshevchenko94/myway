<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "priorities_goals".
 *
 * @property int $id
 * @property string $name
 */
class PrioritiesGoals extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'priorities_goals';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public static function getPrioritiesGoals()
    {
        return self::find()->all();
    }
}
