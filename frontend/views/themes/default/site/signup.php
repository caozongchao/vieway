<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '注册_视途网';
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="fh5co-main">
    <div class="fh5co-narrow-content animate-box" data-animate-effect="fadeInLeft">
        <div class="row">
            <div class="col-md-4">
                <h2>注册</h2>
            </div>
        </div>
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
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
                                <?= Html::submitButton('注 册', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
