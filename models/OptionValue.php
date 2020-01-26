<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "option_value".
 *
 * @property int $id
 * @property string $value
 * @property int $option_id
 *
 * @property Option $option
 * @property ProductVariantOption[] $productVariantOptions
 */
class OptionValue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'option_value';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value', 'option_id'], 'required'],
            [['option_id'], 'default', 'value' => null],
            [['option_id'], 'integer'],
            [['value'], 'string', 'max' => 511],
            [['option_id'], 'exist', 'skipOnError' => true, 'targetClass' => Option::className(), 'targetAttribute' => ['option_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'Value',
            'option_id' => 'Option ID',
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
    public function getProductVariantOptions()
    {
        return $this->hasMany(ProductVariantOption::className(), ['option_value_id' => 'id']);
    }
}
