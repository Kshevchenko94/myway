<?php

use yii\db\Migration;

/**
 * Class m180713_210442_priorities_goals
 */
class m180713_210442_priorities_goals extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('priorities_goals',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string()->notNull()
        ]);

        $this->batchInsert('priorities_goals',['name'],[['Без приоритета'],['&#128293;'],['&#128293;&#128293;'],['&#128293;&#128293;&#128293;']]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('priorities_goals');
    }
}
