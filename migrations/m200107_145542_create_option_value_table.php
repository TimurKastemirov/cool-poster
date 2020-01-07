<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%option_value}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%option}}`
 */
class m200107_145542_create_option_value_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%option_value}}', [
            'id' => $this->primaryKey(),
            'value' => $this->string(511)->notNull(),
            'option_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `option_id`
        $this->createIndex(
            '{{%idx-option_value-option_id}}',
            '{{%option_value}}',
            'option_id'
        );

        // add foreign key for table `{{%option}}`
        $this->addForeignKey(
            '{{%fk-option_value-option_id}}',
            '{{%option_value}}',
            'option_id',
            '{{%option}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%option}}`
        $this->dropForeignKey(
            '{{%fk-option_value-option_id}}',
            '{{%option_value}}'
        );

        // drops index for column `option_id`
        $this->dropIndex(
            '{{%idx-option_value-option_id}}',
            '{{%option_value}}'
        );

        $this->dropTable('{{%option_value}}');
    }
}
