<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Addi;
use common\models\Level;
use common\widgets\JsBlock;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\View */
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

                <?= $form->field($model, 'province', [
                    'labelOptions' => ['class'=>'col-lg-2 control-label'],
                    'template' => '{label}<div class="col-lg-10">{input}{error}</div>',
                ])->widget(Select2::classname(), [
                    'data' => Addi::getProvinces(),
                    'options' => [/*'placeholder' => 'Select a state ...',*/'onchange'=>'ajaxCity('.'$(this).val()'.')'],
                    'pluginOptions' => [
                        // 'allowClear' => true
                    ],
                ]); ?>

                <?= $form->field($model, 'city', [
                    'labelOptions' => ['class'=>'col-lg-2 control-label'],
                    'template' => '{label}<div class="col-lg-10">{input}{error}<span style="color:#f00">修改请重新选择</span></div>',
                ])->dropDownList(['2' => '北京',],[
                    'id' => 'city',
                    'class' => 'form-control',
                ])->widget(Select2::classname(), [
                    'data' => ['2' => '北京',],
                    'options' => ['id' => 'city'],
                    'pluginOptions' => [
                        // 'allowClear' => true
                    ],
                ]); ?>

                <?= $form->field($model, 'level', [
                    'labelOptions' => ['class'=>'col-lg-2 control-label'],
                    'template' => '{label}<div class="col-lg-10">{input}{error}</div>',
                ])->dropDownList(Level::getLevelList(),[
                    'class' => 'form-control',
                ]) ?>

                <?= $form->field($model, 'summary',[
                    'labelOptions' => ['class'=>'col-lg-2 control-label'],
                    'template' => '{label}<div class="col-lg-10">{input}{error}</div>',
                ])->widget(\yii\redactor\widgets\Redactor::className()) ?>

                <?php if ($model->isNewRecord): ?>
                    <?= $form->field($uploadForm, 'imgs[]', [
                        'labelOptions' => ['class'=>'col-lg-2 control-label'],
                        'template' => '{label}<div class="col-lg-10">{input}{error}</div>',
                    ])->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
                <?php else: ?>
                    <?= $form->field($uploadForm, 'imgs[]', [
                        'labelOptions' => ['class'=>'col-lg-2 control-label'],
                        'template' => '{label}<div class="col-lg-10">{input}上传会覆盖之前图片，不上传不改变{error}</div>',
                    ])->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
                <?php endif?>

                <?= $form->field($model, 'img', [
                    'labelOptions' => ['class'=>'col-lg-2 control-label'],
                    'template' => '{label}<div class="col-lg-10">{input}{error}</div>',
                ])->hiddenInput()->label(false) ?>

                <?php if ($model->isNewRecord): ?>
                    <?= $form->field($uploadForm, 'scan_img', [
                        'labelOptions' => ['class'=>'col-lg-2 control-label'],
                        'template' => '{label}<div class="col-lg-10">{input}{error}</div>',
                    ])->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
                <?php else: ?>
                    <?= $form->field($uploadForm, 'scan_img', [
                        'labelOptions' => ['class'=>'col-lg-2 control-label'],
                        'template' => '{label}<div class="col-lg-10">{input}上传会覆盖之前图片，不上传不改变{error}</div>',
                    ])->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
                <?php endif?>

                <?= $form->field($model, 'scan_img', [
                    'labelOptions' => ['class'=>'col-lg-2 control-label'],
                    'template' => '{label}<div class="col-lg-10">{input}{error}</div>',
                ])->hiddenInput()->label(false) ?>

                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <?php
                        echo Html::submitButton($model->isNewRecord ? '新建' : '更新', [
                            'class' => $model->isNewRecord ? 'btn btn-danger' : 'btn btn-danger'])
                        ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </section>
    </div>
</div>
<?php JsBlock::begin(['pos' => \yii\web\View::POS_END]) ?>
<script>
function ajaxCity(id)
{
    if (id == 2) {
        $("#city").empty();
        $("#city").append("<option value='2'>北京</option>");
    }else if(id == 19){
        $("#city").empty();
        $("#city").append("<option value='19'>天津</option>");
    }else if(id == 857){
        $("#city").empty();
        $("#city").append("<option value='857'>上海</option>");
    }else if(id == 2459){
        $("#city").empty();
        $("#city").append("<option value='2459'>重庆</option>");
    }else{
        $.ajax({
            url: '<?= Yii::$app->params['hostUrl'].'addi/ajax-get-citys.html'?>',
            type: 'GET',
            dataType: 'json',
            data: {id: id},
            success: function(data){
                $("#city").empty();
                $.each(data, function(index, val) {
                    // console.log(index);console.log(val);
                    $("#city").append("<option value='"+index+"'>"+val+"</option>");
                });
            }
        })
    }
}
</script>
<?php JsBlock::end() ?>