<?php

/* @var $this yii\web\View */

$this->registerCssFile('@web/statics/assets/font-awesome/css/font-awesome.css', ['depends'=>'backend\assets\AppAsset']);
$this->registerCssFile('@web/statics/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css', ['depends'=>'backend\assets\AppAsset']);
$this->registerCssFile('@web/statics/css/owl.carousel.css', ['depends'=>'backend\assets\AppAsset']);

$this->registerJsFile('@web/statics/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js', ['depends'=>'backend\assets\AppAsset']);
$this->registerJsFile('@web/statics/js/owl.carousel.js', ['depends'=>'backend\assets\AppAsset']);
$this->registerJsFile('@web/statics/js/jquery.customSelect.min.js', ['depends'=>'backend\assets\AppAsset']);
$this->registerJsFile('@web/statics/js/respond.min.js', ['depends'=>'backend\assets\AppAsset']);
$this->registerJsFile('@web/statics/js/sparkline-chart.js', ['depends'=>'backend\assets\AppAsset']);
$this->registerJsFile('@web/statics/js/easy-pie-chart.js', ['depends'=>'backend\assets\AppAsset']);
$this->registerJsFile('@web/statics/js/count.js', ['depends'=>'backend\assets\AppAsset']);

$this->registerJs("
      //owl carousel

      $(document).ready(function() {
          $(\"#owl-demo\").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true,
              autoPlay:true

          });
      });

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });
");
$this->registerCssFile('@web/css/site.css', ['depends'=>'backend\assets\AppAsset']);

$this->title = '管理后台';
?>
<div class="site-index">
    <div class="jumbotron" style="padding:150px 0px;">
        <h2>欢迎 <b><?=Yii::$app->user->identity->username;?></b>!</h2>
        <p class="lead"></p>
        <p><a class="btn btn-lg btn-success" href="#">您已经成功登录</a></p>
    </div>
</div>
