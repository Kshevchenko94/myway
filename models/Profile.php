<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

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
 */
class Profile extends \yii\db\ActiveRecord
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
            [['name', 'surname', 'password', 'sex', 'telephone', 'vk', 'instagram', 'facebook', 'place_job', 'position', 'skills','city_id'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['vk','instagram','facebook'], 'url'],
			[['avatar'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
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
            'city_id' => 'city',
            'date_birth' => 'Date Birth',
            'status' => 'Status',
            'email' => 'Email',
        ];
    }

    public static function getAge($date_birth)
    {
        $date_birth = strtotime($date_birth);
        $date_now = time();
        return floor(($date_now - $date_birth)/(60*60*24*365));
    }

    public static function getCity($id)
    {
        $city = new City();
        $res = json_decode($city->searchCities(['cityId'=>$id]));
        return $res->result[0]->name;
    }

    public function getValues()
    {
        return $this->hasMany(Values::className(), ['id_user'=>'id'])->limit(5);
    }

    public function getGoals()
    {
        return $this->hasMany(Goals::className(), ['id_user'=>'id'])->limit(7);
    }
}
