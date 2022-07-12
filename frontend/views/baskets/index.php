<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \frontend\models\Baskets $model */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<h1>Корзина</h1>
<div class="row" style="background-color: #f9f9f9; padding-left: 30px; padding-top: 30px">
    <form id='toOrder' action="../controllers/toOrder.php" method="post" style='display: flex; flex-direction: column; width: 1080px'>
        <?php foreach ($basket as $item): ?>
            <div style='display: flex; flex-direction: row; justify-content: space-between; width: 100%'>
                <?= Html::a('Удалить', ['baskets/delete', 'id' => $item["id"]], ['class' => 'btn btn-primary delete-basket delete-btn']) ?>
                <p class='product-info'><?= $item["category"] ?></p>
                <p class='product-info'><?= $item["sort"] ?></p>
                <p class='product-info'><?= $item["price"] ?> p/кг</p>
                <p class='product-info'><?= $item["max_kol"] ?> кг</p>
                <input type='hidden' name='product_id[]'  value='<?= $item["product_id"] ?>'>
                <input type='hidden' name='price[]'  value='<?= $item["price"] ?>'>
                <input type='hidden' name='max_kol[]'  value='<?= $item["max_kol"] ?>'>

                <input type='text' name='order-kol[]' id='order-kol' style='min-width: 300px;' placeholder='Введите количество товара, кг' value="2" required>
            </div>
        <?php endforeach; ?>
        <div style='display: flex; flex-direction: row; justify-content: space-between; width: 100%'>
            <input type='hidden' name='user_id'  id='user_id' value='<?= Yii::$app->user->id ?>'>
            <input type='text' name='address' id='address' placeholder='Введите адрес' value='Минск, Белорусская 21' required>
            <input type='tel' name='number_of_phone' id='number_of_phone' placeholder='Введите телефон' value='+375 44 702-14-29' required>
            <input type='submit' class="btn btn-primary btn-toOrder" value='Заказать'>
        </div>
    </form>
</div>
