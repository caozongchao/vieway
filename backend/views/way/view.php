<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Way */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Ways', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="wrapper site-min-height">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <?=$this->title?>
                </header>
                <div class="panel-body">
                    <p>
                        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('删除', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) ?>
                        <?= Html::a('继续添加该景区路线', ['create', 'id' => $model->view_id], ['class' => 'btn btn-primary']) ?>
                    </p>
                    <div class="row">
                        <div class="col-lg-11">
                            <?=
                            DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    'id',
                                    'name',
                                    'view_id',
                                    'view_path',
                                ],
                                'template' => '<tr><th style="width:25%">{label}</th><td>{value}</td></tr>'
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>
</section>
