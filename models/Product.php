<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $custom_id
 * @property string $name
 * @property string $url
 * @property string $description
 * @property bool $is_visible
 * @property int $category_id
 * @property string $full_url
 * @property int $brand_id
 *
 * @property Brand $brand
 * @property Category $category
 * @property ProductImage[] $productImages
 * @property Image[] $images
 * @property ProductVariant[] $productVariants
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['custom_id', 'name', 'url', 'category_id', 'full_url', 'brand_id'], 'required'],
            [['description'], 'string'],
            [['is_visible'], 'boolean'],
            [['category_id', 'brand_id'], 'default', 'value' => null],
            [['category_id', 'brand_id'], 'integer'],
            [['custom_id'], 'string', 'max' => 45],
            [['name', 'url'], 'string', 'max' => 255],
            [['full_url'], 'string', 'max' => 511],
            [['full_url'], 'url'],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::className(), 'targetAttribute' => ['brand_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'custom_id' => 'Custom ID',
            'name' => 'Name',
            'url' => 'Url',
            'description' => 'Description',
            'is_visible' => 'Is Visible',
            'category_id' => 'Category ID',
            'full_url' => 'Full Url',
            'brand_id' => 'Brand ID',
        ];
    }

    public function setDefaultCreateValues()
    {
        $this->is_visible = true;
        $this->description = 'product default description';
        return $this;
    }

    /**
     * @return yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['id' => 'brand_id']);
    }

    /**
     * @return yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return yii\db\ActiveQuery
     */
    public function getProductImages()
    {
        return $this->hasMany(ProductImage::className(), ['product_id' => 'id']);
    }

    /**
     * @return yii\db\ActiveQuery
     * @throws yii\base\InvalidConfigException
     */
    public function getImages()
    {
        return $this->hasMany(Image::className(), ['id' => 'image_id'])->viaTable('product_image', ['product_id' => 'id']);
    }

    /**
     * @return yii\db\ActiveQuery
     */
    public function getProductVariants()
    {
        return $this->hasMany(ProductVariant::className(), ['product_id' => 'id']);
    }
}
