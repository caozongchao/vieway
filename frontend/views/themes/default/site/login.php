<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\captcha\Captcha;

$this->title = '登录_视途网';
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="fh5co-main">
    <div class="fh5co-narrow-content animate-box" data-animate-effect="fadeInLeft">
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6">
                            <h2>登录</h2>
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
                                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                                ]) ?>
                            </div>
                            <div class="form-group">
                                <?= Html::submitButton('登 录', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
        <?php
            // echo yii\authclient\widgets\AuthChoice::widget([
            //         'baseAuthUrl' => ['site/auth'],
            //         'popupMode' => false,
            // ])
        ?>
        <a href="<?=Url::to(['site/auth','authclient'=>'qq'])?>">QQ登录</a>
    </div>
</div>

