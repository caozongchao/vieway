<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\JsBlock;
use common\models\Addi;
use yii\widgets\LinkPager;
$this->title = '视途网首页_景区路线与景点路线规划平台';
?>
<style>
/* select */
.select{width:99%;font-size:12px}
.select li{list-style:none;padding:10px 0 0px 10px}
.select .select-list{border-bottom:#eee 1px dashed}
.select dl{zoom:1;position:relative;line-height:24px;margin-bottom: 0px;}
.select dl:after{content:" ";display:block;clear:both;height:0;overflow:hidden}
.select dt{width:100px;margin-bottom:5px;position:absolute;top:0;left:-100px;text-align:right;color:#666;height:24px;line-height:24px}
.select dd{float:left;display:inline;margin:0 0 10px 10px;}
.select a{display:inline-block;white-space:nowrap;height:24px;padding:0 10px;text-decoration:none;color:#039;border-radius:2px;}
.select a:hover{color:#f60;background-color:#f3edc2}
.select .selected a{color:#fff;background-color:#22B271}
.select-result dt{font-weight:bold}
.select-no{color:#999}
.select .select-result a{padding-right:20px;background:#f60 url("close.gif") right 9px no-repeat}
.select .select-result a:hover{background-position:right -15px}
</style>
<div id="fh5co-main">
    <div>
        <ul class="select">
            <li class="select-list">
                <dl id="selectP">
                    <dt>省份：</dt>
                    <dd class="select-all selected"><a href="javascript:void(0)" id="P0">全部</a></dd>
                    <?php foreach (Addi::getProvinces() as $key => $value): ?>
                        <dd><a href="javascript:void(0)" id="<?=$key?>""><?=$value?></a></dd>
                    <?php endforeach ?>
                </dl>
            </li>
            <li class="select-list">
                <dl id="selectC">
                    <dt>市：</dt>
                    <dd class="select-all selected"><a href="javascript:void(0)" id="C0">全部</a></dd>
                </dl>
            </li>
            <li class="select-list">
                <dl id="selectL">
                    <dt>星级：</dt>
                    <dd class="select-all selected"><a href="javascript:void(0)" id="L0">全部</a></dd>
                    <dd><a href="javascript:void(0)" id="L5">AAAAA</a></dd>
                    <dd><a href="javascript:void(0)" id="L4">AAAA</a></dd>
                    <dd><a href="javascript:void(0)" id="L3">AAA</a></dd>
                    <dd><a href="javascript:void(0)" id="L2">AA</a></dd>
                    <dd><a href="javascript:void(0)" id="L1">A</a></dd>
                </dl>
            </li>
        </ul>
    </div>
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
<?php JsBlock::begin(['pos' => \yii\web\View::POS_END]) ?>
<script>
$(document).ready(function(){
    $("#selectP dd").click(function () {
        $(this).addClass("selected").siblings().removeClass("selected");
        ajaxCities();
    });
    $("#selectC").on('click','dd',function () {
        $(this).addClass("selected").siblings().removeClass("selected");
        ajaxViews();
    });
    $("#selectL dd").click(function () {
        $(this).addClass("selected").siblings().removeClass("selected");
        ajaxViews();
    });
});
function ajaxCities()
{
    $("#selectC").empty().append("<dt>市：</dt><dd class=\"select-all selected\"><a href=\"javascript:void(0)\" id=\"C0\">全部</a></dd>");
    id = $("#selectP .selected a").attr("id");
    if (id == 'P0') {ajaxViews();return false;}
    if (id == 2) {
        $("#selectC").append("<dd><a href=\"javascript:void(0)\" id=\"2\">北京</a></dd>");
    }else if(id == 19){
        $("#selectC").append("<dd><a href=\"javascript:void(0)\" id=\"19\">天津</a></dd>");
    }else if(id == 857){
        $("#selectC").append("<dd><a href=\"javascript:void(0)\" id=\"857\">上海</a></dd>");
    }else if(id == 2459){
        $("#selectC").append("<dd><a href=\"javascript:void(0)\" id=\"2459\">重庆</a></dd>");
    }else{
        $.ajax({
            url: '<?=Url::to(['addi/ajax-get-citys'])?>',
            type: 'GET',
            dataType: 'json',
            data: {id: id},
            success: function(data){
                $.each(data, function(index, val) {
                    $("#selectC").append("<dd><a href=\"javascript:void(0)\" id=\""+index+"\">"+val+"</a></dd>");
                });
            }
        })
    }
    ajaxViews();
}
function ajaxViews()
{
    id = $("#selectC .selected a").attr("id");
    if (id == "C0") {id = $("#selectP .selected a").attr("id");}
    level = $("#selectL .selected a").attr("id");
    $.ajax({
        url: '<?=Url::to(['site/ajax-get-views'])?>',
        type: 'GET',
        dataType: 'json',
        data: {id: id,level:level},
        success: function(data){
            // console.log(data.pages);
            $(".fh5co-gallery").empty();
            $.each(data.views, function(index, val) {
                $(".fh5co-gallery").append("<a class=\"gallery-item\" href=\"<?= Yii::$app->params['hostUrl']?>"+val.id+".html\"><img src=\"<?= Yii::$app->params['hostUrl']?>"+val.scan_img+"\" alt=\"\"><span class=\"overlay\"><h2>"+val.name+"</h2></span></a>");
            });
            $("#pages").html(data.pages);
        }
    })
}
</script>
<?php JsBlock::end() ?>

