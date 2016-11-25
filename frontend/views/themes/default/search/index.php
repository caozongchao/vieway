<?php
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use common\models\View;
/* @var $this yii\web\View */

?>
<div id="fh5co-main">
    <div class="fh5co-gallery">
        <?php foreach ($views as $key => $view): ?>
            <a class="gallery-item" href="<?=Url::to(['site/show','id' => $view['id']],true);?>">
            <?php $viewAll = View::findOne($view['id']);?>
                <img src="<?=Yii::$app->params['hostUrl'].'/'.$viewAll['scan_img']?>" alt="<?=$view['name']?>">
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
