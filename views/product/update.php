<?php

    use yii\helpers\Html;

    /**
     * @var $this yii\web\View
     * @var $product app\models\Product
     * @var $image app\models\Image
     * @var $categoryDropDownOpts array
     * @var $brandDropDownOpts array
     */

    $this->title = 'Update Product: ' . $product->name;
    $this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
    $this->params['breadcrumbs'][] = ['label' => $product->name, 'url' => ['view', 'id' => $product->id]];
    $this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'product' => $product,
        'image' => $image,
        'categoryDropDownOpts' => $categoryDropDownOpts,
        'brandDropDownOpts' => $brandDropDownOpts,
    ]) ?>

</div>
