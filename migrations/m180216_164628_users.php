<?php

use yii\db\Migration;

/**
 * Class m180216_164628_users
 */
class m180216_164628_users extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
		$this->createTable('users', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'surname' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'avatar' => $this->string()->defaultValue(null),
            'sex' => $this->string()->defaultValue(null),
            'telephone' => $this->string()->defaultValue(null),
            'vk' => $this->string()->defaultValue(null),
            'instagram' => $this->string()->defaultValue(null),
            'facebook' => $this->string()->defaultValue(null),
            'place_job' => $this->string()->defaultValue(null),
            'position' => $this->string()->defaultValue(null),
            'income' => $this->integer()->defaultValue(null),
            'skills' => $this->string()->defaultValue(null),
            'city_id' => $this->string(32)->defaultValue(null),
            'date_birth' => $this->date()->defaultValue(null),
            'status' => $this->integer()->defaultValue(null),
            'email' => $this->string()->notNull()->unique(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
		$this->dropTable('users');
    }
}
