<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_variant".
 *
 * @property int $id
 * @property int $product_id
 * @property string $sku
 * @property string $vendor_code
 * @property string $price
 * @property int $quantity
 *
 * @property Product $product
 * @property ProductVariantOption[] $productVariantOptions
 * @property Option[] $options
 */
class ProductVariant extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_variant';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'sku', 'vendor_code', 'price'], 'required'],
            [['product_id', 'quantity'], 'default', 'value' => null],
            [['product_id', 'quantity'], 'integer'],
            [['price'], 'number'],
            [['sku', 'vendor_code'], 'string', 'max' => 45],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'sku' => 'Sku',
            'vendor_code' => 'Vendor Code',
            'price' => 'Price',
            'quantity' => 'Quantity',
        ];
    }

    /**
     * @return yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return yii\db\ActiveQuery
     */
    public function getProductVariantOptions()
    {
        return $this->hasMany(ProductVariantOption::className(), ['product_variant_id' => 'id']);
    }

    /**
     * @return yii\db\ActiveQuery
     * @throws yii\base\InvalidConfigException
     */
    public function getOptions()
    {
        return $this->hasMany(Option::className(), ['id' => 'option_id'])->viaTable('product_variant_option', ['product_variant_id' => 'id']);
    }
}
