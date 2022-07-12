<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\OrdersSearch */
/* @var $products frontend\models\Products */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Orders', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'number',
//            'product_id',
            [
                'attribute' => 'product_id',
                'format' => 'raw',
                'value' => function ($products){
                    return Html::a($products->product_id, ['products/view', 'id' => $products->product_id]);
                }
            ],
//            'user_id',
            [
                'attribute' => 'user_id',
                'format' => 'raw',
                'value' => function ($products){
                    return Html::a($products->user_id, ['users/view', 'id' => $products->user_id]);
                }
            ],
            'kol',
            'cost',
            'address',
            'phone',
            'status',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
