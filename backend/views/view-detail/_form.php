<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ViewDetail */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <?=$this->title?>
            </header>
            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'options'=>[
                        'class'=>'form-horizontal',
                        'enctype' => 'multipart/form-data',
                    ]
                ]); ?>

                <?= $form->field($model, 'name', [
                    'labelOptions' => ['class'=>'col-lg-2 control-label'],
                    'template' => '{label}<div class="col-lg-10">{input}{error}</div>',
                ])->textInput([
                    'class' => 'form-control',
                    'maxlength' => true,
                ]) ?>

                <?= $form->field($model, 'summary', [
                    'labelOptions' => ['class'=>'col-lg-2 control-label'],
                    'template' => '{label}<div class="col-lg-10">{input}{error}</div>',
                ])->widget(\yii\redactor\widgets\Redactor::className()) ?>

                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <?php
                        echo Html::submitButton($model->isNewRecord ? '新建' : '更新', [
                            'class' => $model->isNewRecord ? 'btn btn-danger' : 'btn btn-danger'])
                        ?>
                    </div>
                </div>

                <?= $form->field($model, 'view_id', [
                    'labelOptions' => ['class'=>'col-lg-2 control-label'],
                    'template' => '{label}<div class="col-lg-10">{input}{error}</div>',
                ])->hiddenInput([
                    'value' => $viewId,
                    'class' => 'form-control',
                ])->label(false) ?>

                <?php ActiveForm::end(); ?>
            </div>
        </section>
    </div>
</div>