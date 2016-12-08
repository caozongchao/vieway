<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\JsBlock;
use common\models\ViewDetail;
use yii\widgets\Breadcrumbs;

// $this->registerCssFile('@web/themes/default/css/lightbox.css');
// $this->registerJsFile('@web/themes/default/js/lightbox.js',['depends'=>['frontend\assets\AppAsset'],'position' => $this::POS_END]);
$this->title = $view['name'].'景区路线_视途网';
$this->params['breadcrumbs'][] = $view['name'];
?>
<style>
p{font-size: 14px;}
.detail{position: relative;z-index: 30;overflow: hidden;}
.icon4{background: url(<?=$this->theme->baseUrl.'/images/icons.png'?>) no-repeat -5px -259px;background-color: #fff;}
.icon5{background: url(<?=$this->theme->baseUrl.'/images/icons.png'?>) no-repeat -5px -339px;background-color: #fff;}
.icon{float: left;width: 53px;height: 53px;z-index: 16;}
.text{float: left;margin: 7px 0 0 12px;}
.text .title{font-size:14px;font-weight:bold;color:#666666;margin-bottom: 0.5em;}
.text .summary{max-width: 600px;font-size: 12px;color: #999; margin-left:10px;}
.vline{display: block;position: absolute;top: 53px;left: 25px;z-index: 15;width: 1px;height: 100%;background-color: #ededed;}
.clearfix{clear:both;}
.accordion{padding:10px 0 0 10px; font-size:18px;}
</style>
<div id="fh5co-main">
    <div class="fh5co-narrow-content animate-box fh5co-border-bottom" data-animate-effect="fadeInLeft">
        <?= Breadcrumbs::widget([
            'homeLink'=>[
                'label' => '首页',
                'url' => Yii::$app->homeUrl,
            ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active" id="main"><a href="javascript:void()"><h2 class="fh5co-heading"><?=$view['name']?></h2></a></li>
            <li role="presentation" id="route"><a href="javascript:void()"><h2 class="fh5co-heading">推荐景区路线</h2></a></li>
        </ul>
        <div id="mainContent">
            <div class="row">
                <div class="col-md-12">
                <?php foreach (explode(',', $view['img']) as $img): ?>
                    <figure><a href="<?=Yii::$app->params['hostUrl'].'/'.$img?>" target="_blank" alt="<?=$view['name']?>" data-lightbox="example"><img src="<?=Yii::$app->params['hostUrl'].'/'.$img?>" alt="<?=$view['name']?>" class="img-responsive"></a>
                        <figcaption></figcaption>
                    </figure>
                <?php endforeach ?>
                </div>
            </div>
            <?=$view['summary']?>
        </div>
        <div id="routeContent">
            <?php foreach ($view['ways'] as $way): ?>
                <?php if (!intval($way['view_path'])): ?>
                    <div class="accordion" id="accordion-<?=$way['id']?>">
                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-<?=$way['id']?>" href="#accordion-element-<?=$way['id']?>"><?=$way['name']?></a>
                            </div>
                            <div id="accordion-element-<?=$way['id']?>" class="accordion-body collapse">
                                <div class="accordion-inner">
                                    <?=$way['view_path']?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="accordion" id="accordion-<?=$way['id']?>">
                        <div class="accordion-group">
                            <div class="accordion-heading">
                                 <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-<?=$way['id']?>" href="#accordion-element-<?=$way['id']?>"><?=$way['name']?></a>
                            </div>
                            <div id="accordion-element-<?=$way['id']?>" class="accordion-body collapse">
                                <div class="accordion-inner">
                                <?php
                                    $pathArray = explode(',', $way['view_path']);
                                    $count = count($pathArray);
                                    $i = 1;
                                ?>
                                <?php foreach ($pathArray as $path): ?>
                                    <?php $viewDetail = ViewDetail::findOne($path);?>
                                    <div class="detail">
                                        <div class="icon <?php if($i == 1 || $i == $count){echo 'icon5';}else{echo 'icon4';} ?>"></div>
                                        <div class="text">
                                            <div class="title"><?=$viewDetail['name']?></div>
                                            <div class="summary"><?=$viewDetail['summary']?></div>
                                        </div>
                                        <span class="vline"></span>
                                        <div class="clearfix"></div>
                                    </div>
                                <?php $i++; ?>
                                <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
            <?php endforeach ?>
        </div>
    </div>
</div>
<?php JsBlock::begin(['pos' => \yii\web\View::POS_END]) ?>
<script>
// $('#summary').popover({"html":true});
$(function() {
    $("#mainContent").show();
    $("#routeContent").hide();
    $("#main").click(function(event) {
        $(this).addClass('active').siblings().removeClass('active');
        $("#mainContent").show();
        $("#routeContent").hide();
    });
    $("#route").click(function(event) {
        $(this).addClass('active').siblings().removeClass('active');
        $("#mainContent").hide();
        $("#routeContent").show();
    });
});
</script>
<?php JsBlock::end() ?>