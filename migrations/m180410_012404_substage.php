<?php

use yii\db\Migration;

/**
 * Class m180410_012404_substage
 */
class m180410_012404_substage extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
		$this->createTable('substage', [
            'id' => $this->primaryKey(),
            'text' => $this->string()->notNull(),
            'id_user' => $this->integer()->notNull(),
            'id_stage' => $this->integer()->notNull(),
        ]);
		$this->addForeignKey(
            'substage_to_stage',
            'substage',
            'id_stage',
            'stage',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('substage');
    }
}
