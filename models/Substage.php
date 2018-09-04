<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "substage".
 *
 * @property int $id
 * @property string $text
 * @property int $id_user
 * @property int $id_stage
 *
 * @property Stages $stage
 */
class Substage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'substage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text', 'id_user', 'id_stage'], 'required'],
            [['id_user', 'id_stage'], 'integer'],
            [['text'], 'string', 'max' => 255],
            [['id_stage'], 'exist', 'skipOnError' => true, 'targetClass' => Stages::className(), 'targetAttribute' => ['id_stage' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'id_user' => 'Id User',
            'id_stage' => 'Id Stages',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStage()
    {
        return $this->hasOne(Stages::className(), ['id' => 'id_stage']);
    }

    public function saveSubStages(array $data, $stage_id)
    {
        die(print_r($data));

        foreach ($data as $substages)
        {
            foreach ($substages as $substage)
            {
                $this->text = $substage;
                $this->id_user = Yii::$app->user->id;
                $this->id_stage = $stage_id;
                $this->save();
            }

        }
    }
}
