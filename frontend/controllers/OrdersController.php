<?php

namespace frontend\controllers;

use frontend\models\Orders;
use frontend\models\OrdersSearch;
use Yii;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index', 'view', 'create', 'update', 'delete'],
                            'roles' => ['admin', 'manager'],
                        ],
                        [
                            'allow' => false,
                            'actions' => ['index', 'view', 'create', 'update', 'delete'],
                            'roles' => ['@', '?'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['client', 'del'],
                            'roles' => ['@', '?'],
                        ],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {



        $model = new Orders();
        $order = (new Query())->select(['id' => 'orders.id', 'category' => 'products.category', 'sort' => 'products.sort', 'kol' => 'orders.kol', 'cost' => 'orders.cost', 'address' => 'orders.address', 'phone' => 'orders.phone', 'status' => 'orders.status', 'number' => 'orders.number'])->from('products')->rightJoin('orders','products.id = orders.product_id')->all();

        if (empty($order)){
            Yii::$app->session->setFlash('error', 'Заказов нет.');
            return $this->redirect(['/products/client']);
        }
        //Сортирование результата в многомерный массив по номеру заказа
        foreach ($order as $item){

            $orders[$item["number"]][] = [ 'id' => $item["id"], 'category' => $item["category"], 'sort' => $item["sort"], 'kol' => $item["kol"], 'cost' => $item["cost"],
                'address' => $item["address"], 'phone' => $item["phone"], 'status' => $item["status"] ];
        }
        return $this->render('index', [
            'model' => $model,
            'orders' => $orders
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Orders();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
//        $model = Orders::find()
//            ->where(['number' => $id])
//            ->one();

        $model = new Orders();


        if ($model->save()) {
            return $this->redirect(['index']);
        }

        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionClient()
    {
        $model = new Orders();
        $order = (new Query())->select(['id' => 'orders.id', 'category' => 'products.category', 'sort' => 'products.sort', 'kol' => 'orders.kol', 'cost' => 'orders.cost', 'address' => 'orders.address', 'phone' => 'orders.phone', 'status' => 'orders.status', 'number' => 'orders.number'])->from('products')->rightJoin('orders','products.id = orders.product_id')->where(['orders.user_id'=> Yii::$app->user->id])->all();

        if (empty($order)){
            Yii::$app->session->setFlash('error', 'Заказов нет.');
            return $this->redirect(['/products/client']);
        }
        //Сортирование результата в многомерный массив по номеру заказа
        foreach ($order as $item){

            $orders[$item["number"]][] = [ 'id' => $item["id"], 'category' => $item["category"], 'sort' => $item["sort"], 'kol' => $item["kol"], 'cost' => $item["cost"],
                'address' => $item["address"], 'phone' => $item["phone"], 'status' => $item["status"] ];
        }
        return $this->render('clientView', [
            'model' => $model,
            'orders' => $orders
        ]);
    }

    public function actionDel($id)
    {
        $model = Orders::find()->where(['number' => $id])->all();
        foreach ($model as $item){

            $item->delete();
        }
        return $this->redirect(['/orders']);
    }
}
