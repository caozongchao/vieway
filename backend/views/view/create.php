<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\View */

$this->title = '添加景区';
$this->params['breadcrumbs'][] = ['label' => 'Views', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="wrapper site-min-height">
    <?=
    $this->render('_form', [
        'model' => $model,
        'uploadForm' => $uploadForm,
    ]);
    ?>
</section>