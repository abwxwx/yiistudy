<?php

use yii\bootstrap\Nav;
use yii\helpers\Html;
//use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

?>

<div class="post">
    <div class="title">
        <h3><?= Html::a($model->title, $model->url); ?></h3>
    </div>

    <div class="author">
        <p> <?php echo $model->author->name . ' 发表于 ' . date('Y年m月d日',$model->created_at); ?>
        </p>
    </div>
    <div class="content">
        <p>
        <?php
            if(mb_strlen($model->content) > 300)
            {
                $content = mb_substr($model->content, 0, 300, 'UTF-8');
                $content .= '...';
            }
            else
            {
                $content = $model->content;
            }
        ?>
        <?= \yii\helpers\Markdown::process($content); ?>
        </p>
    </div>
    <nav class="navbar navbar-default" role="navigation"  style="padding:15px 5px">

        <span><b>标签:  </b>
        <?php
        $tags = explode(',', $model->tags);
        foreach($tags as $tag)
        {
            echo $tag, ' ';
        }
        ?>
        </span>
        <span class="pull-right"><?php echo Html::a("Comments ({$model->commentCount})",$model->url.'#comments'); ?>
        </span>
    </nav>
    <hr style="height:1px;border:none;border-top:1px dashed #0066CC;" />
</div>

