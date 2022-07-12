<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

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
                <form id='toOrder' action="../controllers/changeOrderStatus.php" style="display: flex; flex-direction: row;" method="post">
                    <select name='status' class='status' id='<?= $key ?>' style='margin: 0; min-width: 200px'>
                        <?php
                        $statuses = ["в обработке", "принят", "передан курьеру", "доставлен"];
                        for ($i = 0; $i < count($statuses); $i++) {
                            if ($statuses[$i] == $value["status"]) {
                                echo "<option value='$statuses[$i]' selected>$statuses[$i]</option>";
                            } else echo "<option value='$statuses[$i]'>$statuses[$i]</option>";
                        }
                        ?>
                    </select>
                    <input type='hidden' name='number'  id='number' value='<?= $key ?>'>
                    <input type='submit' class="btn btn-primary btn-toOrder" value='Сохранить'>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>