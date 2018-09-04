<?php

use yii\db\Migration;

/**
 * Class m180221_152814_criteries_goals
 */
class m180221_152814_criteries_goals extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
		$this->createTable('criteries_goals', [
            'id' => $this->primaryKey(),
            'name' => $this->text()->notNull(),
            'color_code' => $this->string()->defaultValue(null),
        ]);

		$this->batchInsert('criteries_goals',['name', 'color_code'],[['Здоровье','#00CC99'],['Спорт','#0099FF'],['Бизнес','#CC66FF'],['Работа','#CC9966'],['Учеба','#FFCC99'],['Семья','#99CC99'],['Отношения','#FF6699'],['Покупки','#FF3333'],['Путешествия','#FF9933'],['Творчество','#FFFF66'],['Саморазвитие','#66FFFF'],['Другое','#CCCCCC']]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('criteries_goals');
    }
}
