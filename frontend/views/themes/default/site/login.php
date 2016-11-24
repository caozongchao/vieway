<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="fh5co-main">
    <div class="fh5co-narrow-content animate-box" data-animate-effect="fadeInLeft">
        <div class="row">
            <div class="col-md-4">
                <h2>登录</h2>
            </div>
        </div>
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                            </div>
                            <div class="form-group">
                                <?= $form->field($model, 'password')->passwordInput() ?>
                            </div>
                            <div class="form-group">
                                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                            </div>
                            <div class="form-group">
                                <?= Html::submitButton('登 录', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

