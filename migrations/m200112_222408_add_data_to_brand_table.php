<?php

use yii\db\Migration;

/**
 * Class m200112_222408_add_data_to_brand_table
 */
class m200112_222408_add_data_to_brand_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('brand', ['name'], [
            ['COOL POSTER']
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('brand');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200112_222408_add_data_to_brand_table cannot be reverted.\n";

        return false;
    }
    */
}
