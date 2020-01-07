<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%category}}`
 * - `{{%brand}}`
 */
class m200107_190713_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'custom_id' => $this->string(45)->notNull(),
            'name' => $this->string(255)->notNull(),
            'url' => $this->string(255)->notNull(),
            'description' => $this->text(),
            'is_visible' => $this->boolean()->defaultValue(true),
            'category_id' => $this->integer()->notNull(),
            'full_url' => $this->string(511)->notNull(),
            'brand_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `category_id`
        $this->createIndex(
            '{{%idx-product-category_id}}',
            '{{%product}}',
            'category_id'
        );

        // add foreign key for table `{{%category}}`
        $this->addForeignKey(
            '{{%fk-product-category_id}}',
            '{{%product}}',
            'category_id',
            '{{%category}}',
            'id',
            'CASCADE'
        );

        // creates index for column `brand_id`
        $this->createIndex(
            '{{%idx-product-brand_id}}',
            '{{%product}}',
            'brand_id'
        );

        // add foreign key for table `{{%brand}}`
        $this->addForeignKey(
            '{{%fk-product-brand_id}}',
            '{{%product}}',
            'brand_id',
            '{{%brand}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%category}}`
        $this->dropForeignKey(
            '{{%fk-product-category_id}}',
            '{{%product}}'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            '{{%idx-product-category_id}}',
            '{{%product}}'
        );

        // drops foreign key for table `{{%brand}}`
        $this->dropForeignKey(
            '{{%fk-product-brand_id}}',
            '{{%product}}'
        );

        // drops index for column `brand_id`
        $this->dropIndex(
            '{{%idx-product-brand_id}}',
            '{{%product}}'
        );

        $this->dropTable('{{%product}}');
    }
}
