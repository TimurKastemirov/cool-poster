<?php

    namespace app\controllers;

    use app\models\Brand;
    use app\models\Category;
    use app\models\Image;
    use app\models\ProductImage;
    use Yii;
    use app\models\Product;
    use app\models\ProductSearch;
    use yii\helpers\ArrayHelper;
    use yii\web\Controller;
    use yii\web\NotFoundHttpException;
    use yii\filters\VerbFilter;

    /**
     * ProductController implements the CRUD actions for Product model.
     */
    class ProductController extends Controller
    {
        /**
         * {@inheritdoc}
         */
        public function behaviors()
        {
            return [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ];
        }

        /**
         * Lists all Product models.
         * @return mixed
         */
        public function actionIndex()
        {
            $searchModel = new ProductSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }

        /**
         * Displays a single Product model.
         * @param integer $id
         * @return mixed
         * @throws NotFoundHttpException if the model cannot be found
         */
        public function actionView($id)
        {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }

        /**
         * Creates a new Product model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate()
        {
            $product = new Product();
            $image = new Image();

            $postReq = Yii::$app->request->post();
            if (
                ($product->load($postReq) && $product->validate())
                && ($image->load($postReq) && $image->validate())
            ) {
                $product->save();
                $image->save();
                $product->link('images', $image);

                return $this->redirect(['view', 'id' => $product->id]);
            }

            $product->setDefaultCreateValues();
            $categoryDropDownOpts = Category::getAsDropDownOptions();
            $brandDropDownOpts = Brand::getAsDropDownOptions();

            return $this->render('create', [
                'product' => $product,
                'image' => $image,
                'categoryDropDownOpts' => $categoryDropDownOpts,
                'brandDropDownOpts' => $brandDropDownOpts,
            ]);
        }

        /**
         * Updates an existing Product model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         * @throws NotFoundHttpException if the model cannot be found
         */
        public function actionUpdate($id)
        {
            $product = $this->findModel($id);
            $image = $product->images[0];

            if ($product->load(Yii::$app->request->post()) && $product->save()) {
                return $this->redirect(['view', 'id' => $product->id]);
            }

            $categoryDropDownOpts = Category::getAsDropDownOptions();
            $brandDropDownOpts = Brand::getAsDropDownOptions();
            return $this->render('update', [
                'product' => $product,
                'image' => $image,
                'categoryDropDownOpts' => $categoryDropDownOpts,
                'brandDropDownOpts' => $brandDropDownOpts,
            ]);
        }

        /**
         * Deletes an existing Product model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         * @throws NotFoundHttpException if the model cannot be found
         * @throws \Throwable
         * @throws yii\db\StaleObjectException
         */
        public function actionDelete($id)
        {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }

        /**
         * Finds the Product model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return Product the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id)
        {
            if (($model = Product::findOne($id)) !== null) {
                return $model;
            }

            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
