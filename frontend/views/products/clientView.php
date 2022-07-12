<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \frontend\models\Baskets $model */
/** @var \frontend\models\SearchForm $search */
/** @var \frontend\models\FilterForm $filter */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\linkpager;

?>
<h1>Наша продукция</h1>
<div class="col-lg-12" style="padding-left: 0; display: flex; flex-direction: row; height: 38px;">
    <?php $form = ActiveForm::begin(['id' => 'search-form', 'action' => Url::to(['/products/search'])]); ?>
        <div style="display: flex; flex-direction: row; height: 38px;">
            <?= $form->field($search, 'search')->textInput(['value' => ''])->label(false); ?>
            <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary products_btn search_btn', 'name' => 'code-button']); ?>
        </div>
    <?php ActiveForm::end(); ?>

    <div style="width: 50px"></div>
    <?php $form = ActiveForm::begin(['id' => 'filter-form', 'action' => Url::toRoute(['products/filter', 'products' => $products])]); ?>
        <div style="display: flex; flex-direction: row; height: 38px;">
            <?= $form->field($filter, 'filter')->dropDownList(['0' => 'нет', '1' => 'по возрастанию цены', '2' => 'по убыванию цены',], ['options' => [$selected => ['selected' => true]], 'style' => 'min-width: 250px'])->label(false); ?>
            <?= Html::submitButton('Сортировать', ['class' => 'btn btn-primary products_btn search_btn', 'name' => 'code-button']); ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>

<div class="row">
    <?php foreach ($products as $Product): ?>
        <div class="col-lg-3" style="display: flex; flex-direction: column; align-items: center; margin-top: 30px;">
            <?php \yii\widgets\Pjax::begin(); ?>
            <?=Html::img('@web/images/products/source/' . $Product['image'], ['alt' => $Product['category'], 'style' => 'width: 100%;']) ?>
            <div style="display: flex; flex-direction: column; align-items: center; width: 100%; padding: 20px;  background-color: #F9F9F9;">
                <p class="p_value p_value_bold"><?=Html::encode("{$Product['category']}") ?></p>
                <p class="p_value"><?=Html::encode("{$Product['sort']}") ?></p>
                <p class="p_value"><?=Html::encode("Цена: {$Product['price']}р.") ?></p>
                <p class="p_value"><?=Html::encode("В наличии: {$Product['max_kol']}кг.") ?></p>
                <?php
                $color = "Grey";
                foreach ($likes_user as $item){
                    if ($item == $Product['id']) $color = "red";
                }
                ?>
                <span class="p_value" style="margin-top: 5px">
                    <a href="<?= Url::toRoute(['products/addlike', 'product_id' => $Product['id']]); ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="<?= $color ?>" class="bi bi-heart-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                        </svg>
                    </a>
                    <label><?=$likes[$Product['id']] ?></label>
                </span>

                <?php if (!Yii::$app->user->can('fullWorkWithOrders', 'fullWorkWithProducts') && !Yii::$app->user->isGuest): $form = ActiveForm::begin(['id' => 'basket-form', 'action' => Url::to(['/baskets/add'])]); ?>
                    <?= $form->field($model, 'user_id')->hiddenInput(['value'=> Yii::$app->user->id])->label(false); ?>
                    <?= $form->field($model, 'product_id')->hiddenInput(['value'=> $Product['id']])->label(false); ?>
                    <?= Html::submitButton('В корзину', ['class' => 'btn btn-primary products_btn', 'name' => 'code-button']); ?>
                <?php ActiveForm::end(); endif; ?>

            </div>
            <?php \yii\widgets\Pjax::end(); ?>
        </div>
    <?php endforeach; ?>
</div>
<?= linkpager::widget(['pagination'=>$pagination]) ?>
