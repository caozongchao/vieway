<?php
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\widgets\LinkPager;
/* @var $this yii\web\View */

$this->params['breadcrumbs'][] = $view['name'];
?>
<div id="fh5co-main">
    <div class="fh5co-gallery">
        <?php foreach ($views as $key => $view): ?>
            <a class="gallery-item" href="<?=Url::to(['site/show','id' => $view['id']],true);?>">
                <img src="<?=Yii::$app->params['hostUrl'].'/'.$view['scan_img']?>" alt="<?=$view['name']?>">
                <span class="overlay">
                    <h2><?=$view['name']?></h2>
                </span>
            </a>
        <?php endforeach ?>
    </div>
    <div id="pages">
        <?php
            echo LinkPager::widget([
                'pagination' => $pages,
            ]);
        ?>
    </div>
</div>
