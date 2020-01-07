<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_variant}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%product}}`
 */
class m200107_192547_create_product_variant_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_variant}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'sku' => $this->string(45)->notNull(),
            'vendor_code' => $this->string(45)->notNull(),
            'price' => $this->decimal(10,2)->notNull(),
            'quantity' => $this->integer(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            '{{%idx-product_variant-product_id}}',
            '{{%product_variant}}',
            'product_id'
        );

        // add foreign key for table `{{%product}}`
        $this->addForeignKey(
            '{{%fk-product_variant-product_id}}',
            '{{%product_variant}}',
            'product_id',
            '{{%product}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%product}}`
        $this->dropForeignKey(
            '{{%fk-product_variant-product_id}}',
            '{{%product_variant}}'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            '{{%idx-product_variant-product_id}}',
            '{{%product_variant}}'
        );

        $this->dropTable('{{%product_variant}}');
    }
}
