<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "option".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 *
 * @property OptionValue[] $optionValues
 * @property ProductVariantOption[] $productVariantOptions
 * @property ProductVariant[] $productVariants
 */
class Option extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'option';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
        ];
    }

    /**
     * @return yii\db\ActiveQuery
     */
    public function getOptionValues()
    {
        return $this->hasMany(OptionValue::className(), ['option_id' => 'id']);
    }

    /**
     * @return yii\db\ActiveQuery
     */
    public function getProductVariantOptions()
    {
        return $this->hasMany(ProductVariantOption::className(), ['option_id' => 'id']);
    }

    /**
     * @return yii\db\ActiveQuery
     * @throws yii\base\InvalidConfigException
     */
    public function getProductVariants()
    {
        return $this->hasMany(ProductVariant::className(), ['id' => 'product_variant_id'])->viaTable('product_variant_option', ['option_id' => 'id']);
    }
}
