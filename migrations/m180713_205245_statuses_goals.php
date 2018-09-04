<?php

use yii\db\Migration;

/**
 * Class m180713_205245_statuses_goals
 */
class m180713_205245_statuses_goals extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('statuses_goals',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string()->notNull()
        ]);

        $this->batchInsert('statuses_goals',['name'],[['Активные цели'],['Выполненные цели'],['Проваленные цели']]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('statuses_goals');
    }
}
