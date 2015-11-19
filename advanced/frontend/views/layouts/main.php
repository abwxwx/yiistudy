<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use common\models\Member;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => '圆圆的精彩生活',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);

            $menuItems = [
                ['label' => '首页', 'url' => ['/site/index']],
                ['label' => '日志', 'url' => ['/post/index']],
               // ['label' => '关于我们', 'url' => ['/site/about']],
               // ['label' => '联系我们', 'url' => ['/site/contact']],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => '注册', 'url' => ['/member/create']];
                //$menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                $menuItems[] = ['label' => '登录', 'url' => ['/site/login']];
            } else {
                $menuItems[] = [
                    'label' => Yii::$app->user->identity->name,
                    'items' => [
                        [
                            'label' => '新建日志',
                            'url' => ['/post/create'],
                        ],
                        [
                            'label' => '日志管理',
                            'url' => ['/post/admin'],
                        ],
                        [
                            'label' => '退出登录',
                            'url'=>['/site/logout'],
                            'linkOptions' => ['data-method' => 'post'],
                            'options' => ['id' => 'logout'],
                        ],
                    ],
                ];
//                $menuItems[] = [
//                    'label' => 'Logout (' . Yii::$app->user->identity->name . ')',
//                    'url' => ['/site/logout'],
//                    'linkOptions' => ['data-method' => 'post']
//                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);

            NavBar::end();
        ?>

        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<script>
    $(function(){
        $("#logout").bind('click', function(){
            if(document.getElementById("publish"))
            {
                var res = confirm("日志正在编辑中，退出登录信息将丢失，确认退出吗？");
                if(!res)
                {
                    $(".dropdown-toggle").click();
                    return false;
                }
            }
        });
    });
</script>
