<?php

use yii\db\Migration;

/**
 * Class m181212_023003_add_column_to_table_goals
 */
class m181212_023003_add_column_to_table_goals extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('goals','is_hide',$this->integer(1)->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('goals','is_hide');
    }
}
