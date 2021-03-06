<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\View;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ViewDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '景点管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="wrapper site-min-height">
    <!-- page start-->
    <section class="panel">
        <header class="panel-heading">
            <?=$this->title?>
        </header>
        <div class="panel-body">
            <div class="adv-table editable-table ">
                <div class="clearfix">
                    <div class="btn-group">
                        <?//= Html::a('新建景点', ['create'], ['class' => 'btn btn-success','style' => 'margin-bottom:15px;']) ?>
                    </div>
                </div>
                <div class="space15"></div>
                <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions' => [
                    'class' => 'table table-striped table-hover table-bordered',
                    'id' => 'editable-sample',
                ],
                'layout'=> '{items}
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="dataTables_info" id="editable-sample_info">{summary}</div>
                        </div>
                        <div class="col-lg-6">
                            <div class="dataTables_paginate paging_bootstrap pagination">{pager}</div>
                        </div>
                    </div>',
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'name',
                    // 'summary:ntext',
                    [
                        'attribute' => 'summary',
                        'format' => 'html',
                    ],
                    [
                        'attribute' => 'view_id',
                        'value'=> function ($model, $key, $index, $column)
                        {
                            $array =  View::find()->select(['name'])->where(['id' => $model->view_id])->column();
                            return $array[0].'('.$model->view_id.')';
                        }
                    ],

                    ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update} {delete}'],
                ],
            ]); ?>
            </div>
        </div>
    </section>
    <!-- page end-->
</section>
