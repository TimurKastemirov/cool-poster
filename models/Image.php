<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "image".
 *
 * @property int $id
 * @property string $src
 * @property string $description
 *
 * @property ProductImage[] $productImages
 * @property Product[] $products
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['src'], 'required'],
            [['description'], 'string'],
            [['src'], 'string', 'max' => 1023],
            ['src', 'url'],
            ['src', 'match', 'pattern' => '/.*\.(?:png|jpg|jpeg)$/'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'src' => 'Src',
            'description' => 'Description',
        ];
    }

    /**
     * @return yii\db\ActiveQuery
     */
    public function getProductImages()
    {
        return $this->hasMany(ProductImage::className(), ['image_id' => 'id']);
    }

    /**
     * @return yii\db\ActiveQuery
     * @throws yii\base\InvalidConfigException
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('product_image', ['image_id' => 'id']);
    }
}
