<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use common\models\Addi;
use common\models\Level;
use common\models\View;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ViewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '景区管理';
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
                        <?= Html::a('新建景区', ['create'], ['class' => 'btn btn-success','style' => 'margin-bottom:15px;']) ?>
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
                    [
                        'attribute'=>'province',
                        'value'=> function ($model, $key, $index, $column)
                        {
                            $array =  Addi::find()->select(['province'])->where(['id' => $model->province])->column();
                            return $array[0];
                        }
                    ],
                    [
                        'attribute'=>'city',
                        'value'=> function ($model, $key, $index, $column)
                        {
                            $array =  Addi::find()->select(['city'])->where(['id' => $model->city])->column();
                            return $array[0];
                        }
                    ],
                    [
                        'attribute'=>'level',
                        'value'=> function ($model, $key, $index, $column)
                        {
                            return Level::getLevelAlias()[$model->level];
                        }
                    ],
                    [
                        'attribute' => 'img',
                        'format' => 'html',
                        'value' =>  function ($model, $key, $index, $column){
                            $str = '';
                            $array = explode(',', $model->img);
                            foreach ($array as $key => $value) {
                                $str .= '<img src="'.Yii::$app->params['hostUrl'].str_replace('\\','/',$value).'" style="width:100px;">';
                            }
                            return $str;
                        },
                    ],
                    [
                        'attribute' => 'scan_img',
                        'format' => 'html',
                        'value' =>  function ($model, $key, $index, $column){
                            $str = '';
                            $array = explode(',', $model->scan_img);
                            foreach ($array as $key => $value) {
                                $str .= '<img src="'.Yii::$app->params['hostUrl'].str_replace('\\','/',$value).'" style="width:100px;">';
                            }
                            return $str;
                        },
                    ],

                    ['class' => 'yii\grid\ActionColumn', 'template' => '{add} {create} {view} {update} {delete}',
                        'buttons' => [
                            'add' => function ($url, $model, $key) {
                                return  Html::a('<span class="glyphicon glyphicon-th"></span>', Url::to(['view-detail/create','id' => $model->id]), ['title' => '添加景点'] ) ;
                            },
                            'create' => function ($url, $model, $key) {
                                return  Html::a('<span class="glyphicon glyphicon-plus"></span>', Url::to(['way/create','id' => $model->id]), ['title' => '添加路线'] ) ;
                            },
                        ]
                    ],
                ],
            ]); ?>
            </div>
        </div>
    </section>
    <!-- page end-->
</section>
