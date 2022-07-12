<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \frontend\models\OrderForm $model */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<h1>Корзина</h1>
<div class="row">
    <?php $form = ActiveForm::begin(['id' => 'basket-form', 'class' => 'basket-form', 'action' => Url::to(['/order'])]); ?>
<!--    <form id='toOrder' action="--><?//= Url::to(['/order/index']) ?><!--" method="post" style='display: flex; flex-direction: column; width: 1080px'>-->
        <?php foreach ($basket as $item): ?>
            <div style='display: flex; flex-direction: row; justify-content: space-between; width: 100%'>
                <?= Html::a('Удалить', ['baskets/delete', 'id' => $item["id"]], ['class' => 'btn btn-primary delete-basket delete-btn']) ?>
                <p class='product-info'><?= $item["category"] ?></p>
                <p class='product-info'><?= $item["sort"] ?></p>
                <p class='product-info'><?= $item["price"] ?> p/кг</p>
                <p class='product-info'><?= $item["max_kol"] ?> кг</p>
<!--                <input type='hidden' name='product-id[]'  value='--><?//= $item["product_id"] ?><!--'>-->
                <?= $form->field($model, 'product_id')->hiddenInput(['value'=> $item["id"]]); ?>
<!--                <input type='hidden' name='product-price[]'  value='--><?//= $item["price"] ?><!--'>-->
                <?= $form->field($model, 'product_price')->hiddenInput(['value'=> $item["price"]]); ?>
<!--                <input type='hidden' name='product-maxkol[]'  value='--><?//= $item["max_kol"] ?><!--'>-->
                <?= $form->field($model, 'product_maxkol')->hiddenInput(['value'=> $item["max_kol"]]); ?>
<!--                <input type='hidden' name='id[]'  value='--><?//= $item["id"] ?><!--'>-->
<!--                <input type='hidden' name='price[]'  value='--><?//= $item["price"] ?><!--'>-->
<!--                <input type='hidden' name='max_kol[]'  value='--><?//= $item["max_kol"] ?><!--'>-->

<!--                <input type='text' name='order-kol[]' id='order-kol' style='min-width: 300px;' placeholder='Введите количество товара, кг' value="2" required>-->
<!--                --><?//= $form->field($model, 'kol')->textInput()->label(false); ?>
            </div>
        <?php endforeach; ?>
        <div style='display: flex; flex-direction: row; justify-content: space-between; width: 100%'>
<!--            <input type='text' name='address' id='address' placeholder='Введите адрес' value='jkxcjvhkb' required>-->
<!--            <input type='tel' name='number_of_phone' id='number_of_phone' placeholder='Введите телефон' value='443332211' required>-->
<!--            --><?//= $form->field($model, 'address')->textInput()->label(false); ?>
<!--            --><?//= $form->field($model, 'phone')->textInput()->label(false); ?>

            <?= Html::submitButton('Заказать', ['class' => 'btn btn-primary btn-toOrder', 'name' => 'code-button']); ?>
<!--            <input type='submit' class="btn btn-primary btn-toOrder" value='Заказать'>-->
        </div>
    <?php ActiveForm::end(); ?>
<!--    </form>-->
</div>
