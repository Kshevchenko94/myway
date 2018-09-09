<?php

use yii\db\Migration;

/**
 * Class m180219_010126_news
 */
class m180219_010126_news extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
		$this->createTable('news', [
            'id' => $this->primaryKey(),
            'text' => $this->text(),
            'date_create' => $this->dateTime()->notNull(),
            'id_goal' => $this->integer()->defaultValue(null),
            'id_user' => $this->integer()->notNull(),
            'file' => $this->string()->defaultValue(null),
            'section' => $this->string()->defaultValue(null),
        ]);
		
		$this->addForeignKey(
            'news_to_user',
            'news',
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
        $this->dropTable('news');
    }
}
