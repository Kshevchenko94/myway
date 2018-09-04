<?php

use yii\db\Migration;

/**
 * Class m180221_223250_goals
 */
class m180221_223250_goals extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
		$this->createTable('goals', [
            'id' => $this->primaryKey(),
            'goal' => $this->string()->notNull(),
            'date_finish_goal' => $this->dateTime()->notNull(),
            'criterion_fifnish_goal' => $this->string()->notNull(),
            'id_user' => $this->integer()->notNull(),
            'category_goal' => $this->integer()->notNull(),
            'priority_goal' => $this->integer()->notNull(),
            'status' => $this->integer()->defaultValue(1),
            'is_public' => $this->boolean()->notNull(),
            'need_goal' => $this->string()->notNull(),
            'doc' => $this->string()->defaultValue(null),
        ]);
		
		
		
		$this->addForeignKey(
            'goals_to_user',
            'goals',
            'id_user',
            'users',
            'id',
            'CASCADE'
        );
		$this->addForeignKey(
            'goals_to_categories_goals',
            'goals',
            'category_goal',
            'criteries_goals',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('goals');
    }
}
