<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
$disabled = 'disabled';
if ($disable == 'enable') {
    $disabled = '';
}
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
<!--                    <?//= Html::button('Получить код', ArrayHelper::merge(['value'=>Url::to(['/site/signup'])], ['class' => 'btn btn-info', 'name' => 'code-button'])); ?>-->

                    <?php

                    echo Html::a('Получить код', ['code'], [
                        'class' => 'btn btn-info',
                        'data' => [
                            'method' => 'post'
                        ]
                    ]);
                    ?>

                    <?= $form->field($model, 'code')->textInput([$disabled])->hint('Проверьте почту и введите код') ?>
<!--                    <?//= Html::error($model, 'code', ['class' => 'error']) ?>-->
                </div

                <div class="form-group">
                    <?= Html::submitButton('Зарегистрироваться', ArrayHelper::merge(['href'=>Url::to(['/site/signup'])], ['class' => 'btn btn-primary', 'name' => 'signup-button', $disabled])); ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
