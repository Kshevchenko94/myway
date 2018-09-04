<?php

use yii\db\Migration;

/**
 * Class m180222_185550_stages
 */
class m180222_185550_stages extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
		$this->createTable('stage', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'date_finish_stage' => $this->date()->notNull(),
            'description' => $this->text()->notNull(),
            'id_user' => $this->integer()->notNull(),
            'goal_id' => $this->integer()->notNull(),
        ]);
		
		$this->addForeignKey(
            'stage_to_goals',
            'stage',
            'goal_id',
            'goals',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('stage');
    }
}
