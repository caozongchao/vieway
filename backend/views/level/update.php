<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Level */

$this->title = '更新等级: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<section class="wrapper site-min-height">
    <?=
    $this->render('_form', [
        'model' => $model,
    ]);
    ?>
</section>