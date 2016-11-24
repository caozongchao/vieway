<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ViewDetail */

$this->title = '添加景点';
$this->params['breadcrumbs'][] = ['label' => 'View Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="wrapper site-min-height">
    <?=
    $this->render('_form', [
        'model' => $model,
        'viewId' => $viewId,
    ]);
    ?>
</section>