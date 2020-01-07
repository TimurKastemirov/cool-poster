<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_variant_option}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%option_value}}`
 * - `{{%product_variant}}`
 * - `{{%option}}`
 */
class m200107_193009_create_junction_table_for_product_variant_and_option_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_variant_option}}', [
            'product_variant_id' => $this->integer(),
            'option_id' => $this->integer(),
            'option_value_id' => $this->integer()->notNull(),
            'PRIMARY KEY(product_variant_id, option_id)',
        ]);

        // creates index for column `option_value_id`
        $this->createIndex(
            '{{%idx-product_variant_option-option_value_id}}',
            '{{%product_variant_option}}',
            'option_value_id'
        );

        // add foreign key for table `{{%option_value}}`
        $this->addForeignKey(
            '{{%fk-product_variant_option-option_value_id}}',
            '{{%product_variant_option}}',
            'option_value_id',
            '{{%option_value}}',
            'id',
            'CASCADE'
        );

        // creates index for column `product_variant_id`
        $this->createIndex(
            '{{%idx-product_variant_option-product_variant_id}}',
            '{{%product_variant_option}}',
            'product_variant_id'
        );

        // add foreign key for table `{{%product_variant}}`
        $this->addForeignKey(
            '{{%fk-product_variant_option-product_variant_id}}',
            '{{%product_variant_option}}',
            'product_variant_id',
            '{{%product_variant}}',
            'id',
            'CASCADE'
        );

        // creates index for column `option_id`
        $this->createIndex(
            '{{%idx-product_variant_option-option_id}}',
            '{{%product_variant_option}}',
            'option_id'
        );

        // add foreign key for table `{{%option}}`
        $this->addForeignKey(
            '{{%fk-product_variant_option-option_id}}',
            '{{%product_variant_option}}',
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
        // drops foreign key for table `{{%option_value}}`
        $this->dropForeignKey(
            '{{%fk-product_variant_option-option_value_id}}',
            '{{%product_variant_option}}'
        );

        // drops index for column `option_value_id`
        $this->dropIndex(
            '{{%idx-product_variant_option-option_value_id}}',
            '{{%product_variant_option}}'
        );

        // drops foreign key for table `{{%product_variant}}`
        $this->dropForeignKey(
            '{{%fk-product_variant_option-product_variant_id}}',
            '{{%product_variant_option}}'
        );

        // drops index for column `product_variant_id`
        $this->dropIndex(
            '{{%idx-product_variant_option-product_variant_id}}',
            '{{%product_variant_option}}'
        );

        // drops foreign key for table `{{%option}}`
        $this->dropForeignKey(
            '{{%fk-product_variant_option-option_id}}',
            '{{%product_variant_option}}'
        );

        // drops index for column `option_id`
        $this->dropIndex(
            '{{%idx-product_variant_option-option_id}}',
            '{{%product_variant_option}}'
        );

        $this->dropTable('{{%product_variant_option}}');
    }
}
