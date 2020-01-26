<?php

use yii\db\Migration;

/**
 * Class m200126_171052_add_data_to_options_table
 */
class m200126_171052_add_data_to_options_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('option', ['name'], [
            ['Размер'],
            ['Комплектация']
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('option');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200126_171052_add_data_to_options_table cannot be reverted.\n";

        return false;
    }
    */
}
