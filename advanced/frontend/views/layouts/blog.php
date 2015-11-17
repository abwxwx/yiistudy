<?php

use yii\bootstrap\Nav;
use frontend\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

?>
<?php $this->beginContent('@frontend/views/layouts/main.php'); //main layout's path ?>
    <div class="row">
        <div class="col-md-9">

            <?= $content ?>
        </div>
        <div class="col-md-3">
            <div class="hidden-xs hidden-ms" id="sidebar" data-spy="affix" data-offset-top="125" style="width:260px">
<!--                --><?php //if(!Yii::$app->user->isGuest) :?>
<!---->
<!--                    --><?php //echo Nav::widget([
//                        'items' => [
//                            [
//                                'label' => '日志首页',
//                                'url' => ['post/index'],
//                            ],
//                            [
//                                'label' => '新建日志',
//                                'url'=>['post/create'],
//                            ],
//                            [
//                                'label' => '日志管理',
//                                'url'=>['post/admin'],
//                            ],
//                            [
//                                'label' => '注销',
//                                'url'=>['site/logout'],
//                                'linkOptions' => ['data-method' => 'post'],
//                            ],
//
//                        ],
//                        'options' => ['class' =>'nav-tabs'],
//                        'encodeLabels'=>false
//                    ]); ?>
<!--                --><?php //endif; ?>

                <br/>
                <br/>
                <?php echo \frontend\components\TagCloud::widget(['maxTags'=>14]); ?>

            </div>
        </div>
    </div>

<?php $this->endContent(); ?>