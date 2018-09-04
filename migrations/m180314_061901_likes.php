<?php

use yii\db\Migration;

/**
 * Class m180314_061901_likes
 */
class m180314_061901_likes extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180314_061901_likes cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180314_061901_likes cannot be reverted.\n";

        return false;
    }
    */
}
