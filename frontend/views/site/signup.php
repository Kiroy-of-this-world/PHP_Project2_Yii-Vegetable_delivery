<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="site-signup">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>Пожалуйста, заполните следующие поля, чтобы зарегистрироваться:</p>

        <div class="row">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(['id' => 'signup-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'password_confirm')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Продолжить', ['class' => 'btn btn-primary', 'name' => 'signup-button']); ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
