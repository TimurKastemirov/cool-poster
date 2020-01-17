<?php


namespace app\controllers;


use app\models\Category;
use app\models\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CategoryController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->get());

        return $this->render('index', [
            'dataProvider'=> $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionView($id)
    {
        $model = Category::find()->where(['id' => $id])->one();
        if (!empty($model)) {
            return $this->render('view', [
                'model' => $model
            ]);
        }

        throw new NotFoundHttpException(404);
    }
}