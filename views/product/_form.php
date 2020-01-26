<?php

    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

    /**
     * @var $this yii\web\View
     * @var $form yii\widgets\ActiveForm
     * @var $product app\models\Product
     * @var $image app\models\Image
     * @var $categoryDropDownOpts array
     * @var $brandDropDownOpts array
     */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($product, 'custom_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($product, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($product, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($product, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($product, 'is_visible')->checkbox() ?>

    <?= $form
        ->field($product, 'category_id')
        ->dropDownList(
            $categoryDropDownOpts,
            [
                'prompt' => [
                    'text' => 'Please select',
                    'options' => [
                        'value' => 'none',
                    ]
                ]
            ]
        ) ?>

    <?= $form
        ->field($product, 'brand_id')
        ->dropDownList(
            $brandDropDownOpts
        ) ?>

    <?= $form->field($product, 'full_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($image, 'src')->textInput(['maxlength' => true])->label('Image url') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
