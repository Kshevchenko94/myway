<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\components\MathHelper;

/**
 * This is the model class for table "goals".
 *
 * @property int $id
 * @property string $goal
 * @property string $date_finish_goal
 * @property string $criterion_fifnish_goal
 * @property int $id_user
 * @property int $category_goal
 * @property int $priority_goal
 * @property int $status
 * @property int $is_public
 * @property string $need_goal
 * @property string $doc
 *
 * @property CriteriesGoals $categoryGoal
 * @property Users $user
 * @property Stages[] $stages
 */
class Goals extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goals';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goal', 'date_finish_goal', 'criterion_fifnish_goal', 'id_user','priority_goal', 'is_public', 'need_goal', 'category_goal'], 'required', 'message'=>'Поле обязательное для заполнения'],
            [['date_finish_goal'], 'safe'],
            [['id_user', 'category_goal', 'priority_goal', 'status', 'is_public'], 'integer'],
            [['goal', 'criterion_fifnish_goal', 'need_goal', 'doc'], 'string', 'max' => 255],
            [['category_goal'], 'exist', 'skipOnError' => true, 'targetClass' => CriteriesGoals::className(), 'targetAttribute' => ['category_goal' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['id_user' => 'id']],
			[['doc'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, gif, jpeg'],
        ];
    }

	public function afterSave($insert, $changedAttributes){
		parent::afterSave($insert, $changedAttributes);
		if($insert)
		{
			$news = new News();
			$news->id_user = $this->id_user;
			$news->id_goal = $this->id;
			$news->date_create = date('Y-m-d H:i:s');
			$news->save();
		}
	}

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goal' => 'Goal',
            'date_finish_goal' => 'Date Finish Goal',
            'criterion_fifnish_goal' => 'Criterion Fifnish Goal',
            'id_user' => 'Id User',
            'category_goal' => 'Category Goal',
            'priority_goal' => 'Priority Goal',
            'status' => 'Status',
            'is_public' => 'Is Public',
            'need_goal' => 'Need Goal',
            'doc' => 'Doc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryGoal()
    {
        return $this->hasOne(CriteriesGoals::className(), ['id' => 'category_goal']);
    }

    public function getPriorityGoal()
    {
        return $this->hasOne(PrioritiesGoals::className(), ['id' => 'priority_goal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStages()
    {
        return $this->hasMany(Stages::className(), ['goal_id' => 'id']);
    }

    public function getReports()
    {
        return $this->hasMany(News::className(), ['id_goal' => 'id'])->andWhere(['section'=>'report'])->orderBy(['id'=>SORT_DESC]);
    }
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getSubstages()
    {
        return $this->hasMany(Substage::className(), ['id_stage' => 'goal_id']);
    }


    public static function getCountGoals(array $params=[])
    {
        $allCount = self::find()->where(['id_user'=>Yii::$app->user->id])->count();
        if($params['status'])
        {
            $count = self::find()->where(['status'=>$params['status'],'id_user'=>Yii::$app->user->id])->count();
            $results = [
                'count'=>$count,
                'procent'=>MathHelper::getProcent(['number'=>$count,'fromNumber'=>$allCount]),
            ];
        }else{
            $results = [
                'count'=>$allCount,
            ];
        }

        return $results;
    }

    public static function getSelectGoals()
    {
        return self::find()->select(['id','goal'])->where(['id_user'=>Yii::$app->user->id])->asArray()->all();
    }

}
