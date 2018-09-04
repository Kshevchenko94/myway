<?php

namespace app\models;

use \yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
	
	public static function tableName()
	{
		return 'users';
	}
	
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null){}

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByUsername($email)
    {
		return static::findOne(['email' => $email]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey(){}

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey){}

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        //return $this->password === $password;
		return \Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }
}
