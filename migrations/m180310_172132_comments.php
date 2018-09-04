<?php

use yii\db\Migration;

/**
 * Class m180310_172132_comments
 */
class m180310_172132_comments extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
		$this->createTable('comments', [
            'id' => $this->primaryKey(),
            'text' => $this->text()->notNull(),
            'date_create' => $this->dateTime()->notNull(),
            'id_user' => $this->integer()->notNull(),
            'id_element' => $this->integer()->notNull(),
            'section' => $this->string()->notNull(),
        ]);
		
		$this->addForeignKey(
            'comments_to_user',
            'comments',
            'id_user',
            'users',
            'id',
            'CASCADE'
        );
		$this->addForeignKey(
            'comments_to_element',
            'comments',
            'id_element',
            'news',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('comments');
    }
}
