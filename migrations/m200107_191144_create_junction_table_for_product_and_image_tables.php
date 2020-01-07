<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_image}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%product}}`
 * - `{{%image}}`
 */
class m200107_191144_create_junction_table_for_product_and_image_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_image}}', [
            'product_id' => $this->integer(),
            'image_id' => $this->integer(),
            'PRIMARY KEY(product_id, image_id)',
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            '{{%idx-product_image-product_id}}',
            '{{%product_image}}',
            'product_id'
        );

        // add foreign key for table `{{%product}}`
        $this->addForeignKey(
            '{{%fk-product_image-product_id}}',
            '{{%product_image}}',
            'product_id',
            '{{%product}}',
            'id',
            'CASCADE'
        );

        // creates index for column `image_id`
        $this->createIndex(
            '{{%idx-product_image-image_id}}',
            '{{%product_image}}',
            'image_id'
        );

        // add foreign key for table `{{%image}}`
        $this->addForeignKey(
            '{{%fk-product_image-image_id}}',
            '{{%product_image}}',
            'image_id',
            '{{%image}}',
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
            '{{%fk-product_image-product_id}}',
            '{{%product_image}}'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            '{{%idx-product_image-product_id}}',
            '{{%product_image}}'
        );

        // drops foreign key for table `{{%image}}`
        $this->dropForeignKey(
            '{{%fk-product_image-image_id}}',
            '{{%product_image}}'
        );

        // drops index for column `image_id`
        $this->dropIndex(
            '{{%idx-product_image-image_id}}',
            '{{%product_image}}'
        );

        $this->dropTable('{{%product_image}}');
    }
}
