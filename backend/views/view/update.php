<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\View */

$this->title = '更新景区: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Views', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<section class="wrapper site-min-height">
    <?=
    $this->render('_form', [
        'model' => $model,
        'uploadForm' => $uploadForm,
    ]);
    ?>
</section>

