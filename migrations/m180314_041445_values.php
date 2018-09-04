<?php

use yii\db\Migration;

/**
 * Class m180314_041445_values
 */
class m180314_041445_values extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
		$this->createTable('values', [
            'id' => $this->primaryKey(),
            'value' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'id_user' => $this->integer()->notNull(),
            'date_create' => $this->date()->notNull(),
        ]);
		$this->addForeignKey(
            'values_to_user',
            'values',
            'id_user',
            'users',
            'id',
            'CASCADE'
        );
    }
	
	

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('values');
    }
}
