<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Way */

$this->title = '添加路线';
$this->params['breadcrumbs'][] = ['label' => 'Ways', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
