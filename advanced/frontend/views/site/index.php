<?php
/* @var $this yii\web\View */
$this->title = 'My Yii Application';
$imagepath = Yii::getAlias('@web').'/images';
?>


<div class="site-index">
<div id="slidershow" class="carousel slide" data-ride="carousel" data-interval="7000">
    <!-- 设置图片轮播的顺序 -->
    <ol class="carousel-indicators">
        <li class="active" data-target="#slidershow" data-slide-to="0"></li>
        <li data-target="#slidershow" data-slide-to="1"></li>
        <li data-target="#slidershow" data-slide-to="2"></li>
    </ol>
    <!-- 设置轮播图片 -->
    <div class="carousel-inner">
        <div class="item active">
            <img src="<?php echo $imagepath.'/IMG_0494.JPG'; ?>" alt="">
        </div>
        <div class="item">
            <img src="<?php echo $imagepath.'/IMG_0515.JPG'; ?>" alt="">
        </div>
        <div class="item">
            <img src="<?php echo $imagepath.'/IMG_9799.JPG'; ?>" alt="">
        </div>
    </div>
    <a class="left carousel-control " href="#slidershow" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="right carousel-control" href="#slidershow" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
</div>
</div>

<style>
    #slidershow{
        height: 500px;
        background-color: #000000;
    }
    #slidershow .item{
        height: 500px;
        background-color: #000000;
    }
    #slidershow .carousel-inner .item img{
        /*图片自动缩放*/
        width:100%;
    }
</style>