<?php

    /**
     * @var $this yii\web\View
     * @var $model app\models\Category
     */

    use yii\widgets\DetailView;

    $this->title = 'Category details';

    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description',
            'is_visible:boolean'
        ],
    ]);