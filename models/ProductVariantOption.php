<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_variant_option".
 *
 * @property int $product_variant_id
 * @property int $option_id
 * @property int $option_value_id
 *
 * @property Option $option
 * @property OptionValue $optionValue
 * @property ProductVariant $productVariant
 */
class ProductVariantOption extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_variant_option';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_variant_id', 'option_id', 'option_value_id'], 'required'],
            [['product_variant_id', 'option_id', 'option_value_id'], 'default', 'value' => null],
            [['product_variant_id', 'option_id', 'option_value_id'], 'integer'],
            [['product_variant_id', 'option_id'], 'unique', 'targetAttribute' => ['product_variant_id', 'option_id']],
            [['option_id'], 'exist', 'skipOnError' => true, 'targetClass' => Option::className(), 'targetAttribute' => ['option_id' => 'id']],
            [['option_value_id'], 'exist', 'skipOnError' => true, 'targetClass' => OptionValue::className(), 'targetAttribute' => ['option_value_id' => 'id']],
            [['product_variant_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductVariant::className(), 'targetAttribute' => ['product_variant_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_variant_id' => 'Product Variant ID',
            'option_id' => 'Option ID',
            'option_value_id' => 'Option Value ID',
        ];
    }

    /**
     * @return yii\db\ActiveQuery
     */
    public function getOption()
    {
        return $this->hasOne(Option::className(), ['id' => 'option_id']);
    }

    /**
     * @return yii\db\ActiveQuery
     */
    public function getOptionValue()
    {
        return $this->hasOne(OptionValue::className(), ['id' => 'option_value_id']);
    }

    /**
     * @return yii\db\ActiveQuery
     */
    public function getProductVariant()
    {
        return $this->hasOne(ProductVariant::className(), ['id' => 'product_variant_id']);
    }
}
