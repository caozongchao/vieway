<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = '注册_视途网';
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="fh5co-main">
    <div class="fh5co-narrow-content animate-box" data-animate-effect="fadeInLeft">
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6">
                            <h2>注册</h2>
                            <div class="form-group">
                                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                            </div>
                            <div class="form-group">
                                <?= $form->field($model, 'email') ?>
                            </div>
                            <div class="form-group">
                                <?= $form->field($model, 'password')->passwordInput() ?>
                            </div>
                            <div class="form-group">
                                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                                ]) ?>
                            </div>
                            <div class="form-group">
                                <?= Html::submitButton('注 册', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
