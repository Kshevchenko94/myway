<?php

namespace app\models;

use yii\web\UploadedFile;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $text
 * @property string $date_create
 * @property int $id_goal
 * @property int $id_user
 * @property string $file
 *
 * @property Users $user
 * @property Goals $goal
 * @property Comments $comments
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_create', 'id_user'], 'required'],
            [['text'], 'string'],
            [['date_create'], 'safe'],
            [['id_user'], 'integer'],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['id_user' => 'id']],
            [['id_goal'], 'exist', 'skipOnError' => true, 'targetClass' => Goals::className(), 'targetAttribute' => ['id_goal' => 'id']],
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
            'date_create' => 'Date Create',
            'id_user' => 'Id User',
            'id_goal' => 'Id Goal',
            'file' => 'File',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'id_user']);
    }
	
	public function getGoal()
    {
        return $this->hasOne(Goals::className(), ['id' => 'id_goal']);
    }
	public function getComments()
    {
        return $this->hasMany(Comments::className(), ['id_element' => 'id']);
    }
	
}
