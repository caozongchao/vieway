<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Way */

$this->title = '修改路线: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Ways', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<section class="wrapper site-min-height">
    <?=
    $this->render('_form', [
        'model' => $model,
        'viewDetails' => $viewDetails,
        'viewId' => $viewId,
    ]);
    ?>
</section>