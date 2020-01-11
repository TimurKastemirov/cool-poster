<?php

use yii\db\Migration;

/**
 * Class m200110_235832_add_data_to_category_table
 */
class m200110_235832_add_data_to_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('category', ['name'], [
            ['Геометрия'],
            ['Детские'],
            ['Животные'],
            ['Карты'],
            ['Кухня'],
            ['Мотивация'],
            ['Наборы'],
            ['Разные'],
            ['Скандинавский'],
            ['Словарь Даля'],
            ['Фешн']
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('category');
    }
}
