<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Way */
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
<?php if (empty($viewDetails)): ?>
                <?= $form->field($model, 'view_path', [
                    'labelOptions' => ['class'=>'col-lg-2 control-label'],
                    'template' => '{label}<div class="col-lg-10">{input}{error}</div>',
                ])->widget(\yii\redactor\widgets\Redactor::className())?>
<?php else: ?>
                <?= $form->field($model, 'view_path', [
                    'labelOptions' => ['class'=>'col-lg-2 control-label'],
                    'template' => '{label}<div class="col-lg-10">{input}{error}</div>',
                ])->widget(Select2::classname(), [
                    'data' => $viewDetails,
                    'maintainOrder' => true,
                    'options' => ['multiple' => true],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]); ?>
<?php endif ?>
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