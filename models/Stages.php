<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\StaleObjectException;

/**
 * This is the model class for table "stage".
 *
 * @property int $id
 * @property string $title
 * @property string $date_finish_stage
 * @property string $description
 * @property int $id_user
 * @property int $goal_id
 *
 * @property Users $goal
 * @property Substage $substages
 */
class Stages extends ActiveRecord
{

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'date_finish_stage',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'date_finish_stage',
                ],
                'value' => function() { return date('Y-m-d', strtotime($this->date_finish_stage));},
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'date_finish_stage', 'description'], 'required'],
            [['date_finish_stage'], 'safe'],
            [['description'], 'string'],
            [['id_user', 'goal_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['goal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Goals::className(), 'targetAttribute' => ['goal_id' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название этапа',
            'date_finish_stage' => 'Date Finish Stages',
            'description' => 'Description',
            'id_user' => 'Id User',
            'goal_id' => 'Goal ID',
            'id_stage' => 'Stages ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoal()
    {
        return $this->hasOne(Users::className(), ['id' => 'goal_id']);
    }

    public function getSubstages()
    {
        return $this->hasMany(Substage::className(), ['id' => 'id_stage']);
    }

    public static function deleteStage($stageId)
    {
        $stage = static::findOne($stageId);

        try {
            $stage->delete();
        } catch (StaleObjectException $e) {
        } catch (\Throwable $e) {
        }
    }

}
