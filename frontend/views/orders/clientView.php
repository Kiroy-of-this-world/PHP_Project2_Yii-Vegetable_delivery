<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

?>
<h1>Заказы</h1>
<div style='display: flex; flex-direction: column; width: 1080px'>
    <?php foreach ($orders as $key => $values): ?>
    <div class="orders" style='display: flex; flex-direction: column; width: 1080px; background-color: #F9F9F9; padding-left: 30px; margin-bottom: 30px;'><span style='margin: 15px 0'>Номер заказа: <?= $key ?></span>
        <?php foreach ($values as $value): ?>
        <div style='display: flex; flex-direction: row;'>
            <p class='product-info'><?= $value["category"] ?></p>
            <p class='product-info'><?= $value["sort"] ?></p>
            <p class='product-info'><?= $value["kol"] ?> кг</p>
            <p class='product-info'><?= $value["cost"] ?> р</p>
            <input type='hidden' name='product-id[]'  value='<?= $value["id"] ?>'>
            <input type='hidden' name='product-price[]'  value='<?= $value["cost"] ?>'>
        </div>
        <?php endforeach; ?>

        <div style='display: flex; flex-direction: row'>
            <p class='product-info'><?= $value["address"] ?></p>
            <p class='product-info'><?= $value["phone"] ?></p>
            <p class='product-info'><?= $value["status"] ?></p>
            <?= Html::a('Отменить', ['orders/del', 'id' => $key], ['class' => 'btn btn-primary delete-basket delete-btn']) ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>