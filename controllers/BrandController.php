<?php


namespace app\controllers;

use app\models\BrandSearch;
use yii\web\Controller;

class BrandController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new BrandSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->get());

        return $this->render('index', [
            'dataProvider'=> $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }
}