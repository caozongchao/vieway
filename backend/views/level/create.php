<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Level */

$this->title = '添加等级';
$this->params['breadcrumbs'][] = ['label' => 'Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="wrapper site-min-height">
    <?=
    $this->render('_form', [
        'model' => $model,
    ]);
    ?>
</section>
