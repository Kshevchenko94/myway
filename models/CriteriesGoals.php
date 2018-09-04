<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "criteries_goals".
 *
 * @property int $id
 * @property string $name
 * @property string $color_code
 */
class CriteriesGoals extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'criteries_goals';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string'],
            [['color_code'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'color_code' => 'Color Code',
        ];
    }

    public static function getCriteriesGoals()
    {
        return self::find()->all();
    }
}
