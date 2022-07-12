<?php

namespace frontend\controllers;

use frontend\models\Baskets;
use frontend\models\OrderForm;
use Yii;
use yii\db\Query;
use yii\web\Controller;

class BasketsController extends Controller
{
    public function actionIndex()
    {
        $model = new OrderForm();
        $basket = (new Query())->select(['user_id' => 'baskets.user_id', 'product_id' => 'baskets.product_id', 'category' => 'products.category', 'sort' => 'products.sort', 'price' => 'products.price', 'max_kol' => 'products.max_kol', 'image' => 'products.image', 'id' => 'baskets.id'])->from('products')->rightJoin('baskets','products.id = baskets.product_id')->where(['baskets.user_id'=> Yii::$app->user->id])->all();

        if (empty($basket)){
            Yii::$app->session->setFlash('error', 'Корзина пуста.');
            return $this->redirect(['/products/client']);
        }
        return $this->render('index', [
            'basket' => $basket,
            'model' => $model
        ]);
    }

    public function actionAdd()
    {
        $model = new Baskets();
        if ($model->load(Yii::$app->request->post())) {
            $flag = true;
            $basket = Baskets::find()->orderBy('id')->all();
            foreach ($basket as $item){
                if ($model->user_id == $item->user_id && $model->product_id == $item->product_id){
                    $flag = false;
                }
            }

            if($flag) {
                $model->save();
                Yii::$app->session->setFlash('success', 'Товар успещно добавлен в корзину.');

                return $this->redirect(['/baskets']);
            }
        }

        Yii::$app->session->setFlash('success', 'Товар уже в корзине');
        return $this->redirect(['/products/client']);
    }

    public function actionDelete($id)
    {
        $model = Baskets::find()->where(['id' => $id])->one();
        $model->delete();
        return $this->redirect(['/baskets']);
    }

    public function actionOrder()
    {
        $model = new OrderForm();
        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->session->setFlash('success', 'Заказ типа сделан.');

            return $this->redirect(['/products/client']);
        }
            return $this->redirect(['/baskets']);
    }
}
