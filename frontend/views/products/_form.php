<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sort')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'max_kol')->textInput() ?>

    <?= $form->field($model, 'image')->fileInput(); ?>
    <?php
    if (!empty($model->image)) {
        $img = Yii::getAlias('@webroot') . '/images/products/source/' .  $model->image;
        if (is_file($img)) {
            $url = Yii::getAlias('@web') . '/images/products/source/' .  $model->image;
            echo 'Уже загружено ', Html::a('изображение', $url, ['target' => '_blank']);
            echo $form->field($model,'remove')->checkbox();
        }
    }
    ?>

<!--    <?//= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>-->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
