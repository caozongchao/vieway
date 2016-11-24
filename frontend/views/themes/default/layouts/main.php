<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js"><!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Free HTML5 Website Template by FreeHTML5.co" />
<meta name="keywords" content="free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
<!-- Facebook and Twitter integration -->
<meta property="og:title" content=""/>
<meta property="og:image" content=""/>
<meta property="og:url" content=""/>
<meta property="og:site_name" content=""/>
<meta property="og:description" content=""/>
<meta name="twitter:title" content="" />
<meta name="twitter:image" content="" />
<meta name="twitter:url" content="" />
<meta name="twitter:card" content="" />
<title><?= Html::encode($this->title) ?></title>
<?php $this->head() ?>
</head>
<body style="background:#FFF">
<?php $this->beginBody() ?>
<?= Alert::widget() ?>
<div id="fh5co-page">
    <a href="javascript:void(0)" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
    <aside id="fh5co-aside" role="complementary" class="border js-fullheight">
        <h1 id="fh5co-logo"><a href="<?=Url::to(['site/index'],true);?>"><img src="<?=$this->theme->baseUrl.'/images/logo-colored.png'?>" alt=""></a></h1>
        <nav id="fh5co-main-menu" role="navigation">
            <ul>
                <li class="fh5co-active"><a href="<?=Url::to(['site/index'],true);?>">首页</a></li>
            </ul>
            <form class="form-search" action="<?=Url::to(['search/index'])?>">
                <input class="search-query" type="text" name="key" style="margin-left:5px;width:95%;font-size:0.5em;" placeholder="搜索景点名称" />
            </form>
        </nav>

        <div class="fh5co-footer">
            <?php if (Yii::$app->user->isGuest): ?>
                <a href="<?=Url::to(['site/signup'],true);?>">注 册</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?=Url::to(['site/login'],true);?>">登 录</a>
            <?php else: ?>
                <a href="<?=Url::to(['user/home'],true);?>">个人中心</a>
            <?php endif;?>
            <p><small>&copy; 2016 caozongchao. <br />All Rights Reserved.</span></small></p>
        </div>
    </aside>
    <?=$content;?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
