<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $password
 * @property string $avatar
 * @property string $sex
 * @property string $telephone
 * @property string $vk
 * @property string $instagram
 * @property string $facebook
 * @property string $place_job
 * @property string $position
 * @property int $income
 * @property string $skills
 * @property string $city_id
 * @property string $date_birth
 * @property int $status
 * @property string $email
 *
 * @property News[] $news
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'password', 'email'], 'required'],
            [['income', 'status'], 'integer'],
            [['date_birth'], 'safe'],
            [['city_id','name', 'surname', 'password', 'avatar', 'sex', 'telephone', 'vk', 'instagram', 'facebook', 'place_job', 'position', 'skills', 'email'], 'string', 'max' => 255],
            [['email'], 'unique'],
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
            'surname' => 'Surname',
            'password' => 'Password',
            'avatar' => 'Avatar',
            'sex' => 'Sex',
            'telephone' => 'Telephone',
            'vk' => 'Vk',
            'instagram' => 'Instagram',
            'facebook' => 'Facebook',
            'place_job' => 'Place Job',
            'position' => 'Position',
            'income' => 'Income',
            'skills' => 'Skills',
            'city_id' => 'Sity ID',
            'date_birth' => 'Date Birth',
            'status' => 'Status',
            'email' => 'Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::className(), ['id_user' => 'id']);
    }
}
