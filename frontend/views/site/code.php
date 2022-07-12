<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Пожалуйста, заполните следующие поля, чтобы зарегистрироваться:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'code-form', 'action' => Url::to(['/site/code'])]); ?>

            <?= $form->field($model, 'username') ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'password_confirm')->passwordInput() ?>

            <?= $form->field($model, 'code')->textInput(['autofocus' => true])->hint('Проверьте почту и введите код') ?>

            <div class="form-group">
                <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary', 'name' => 'code-button']); ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
