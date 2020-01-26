<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'custom_id',
            'name',
            'url:url',
            'description:ntext',
            'is_visible:boolean',
            [
                'label' => 'Brand',
                'value' => $model->brand->name,
            ],
            [
                'label' => 'Category',
                'value' => $model->category->name,
            ],
            'full_url:url',
        ],
    ]) ?>

    <div class="row">
        <?php
            foreach ($model->images as $image)
            {
        ?>
                <div class="col-xs-6 col-md-3">
                    <a href="#" class="thumbnail">
                        <img src="<?=$image->src?>" alt="<?=$image->description?>">
                    </a>
                </div>
        <?php
            }
        ?>
    </div>

</div>
