<?php
    /**
     * @var $this yii\web\View
     * @var $dataProvider
     * @var $searchModel
     */

    use yii\grid\GridView;

    $this->title = 'Category';

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'description',
            'is_visible',
            ['class' => 'yii\grid\ActionColumn']
        ],
    ]);