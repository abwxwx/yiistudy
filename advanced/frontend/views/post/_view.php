<?php

use yii\bootstrap\Nav;
use yii\helpers\Html;
//use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

?>

<div class="post">
    <div class="title">
        <h1><?= Html::a($model->title, $model->url); ?></h1>
    </div>

    <div class="author">
        <p> posted by <?php echo $model->author->name . ' on ' . date('F j, Y',$model->created_at); ?>
        </p>
    </div>
    <div class="content">
        <p>
<!--        --><?php
//            if(mb_strlen($model->content) > 400)
//            {
//                $content = mb_substr($model->content, 0, 400, 'UTF-8');
//                $content .= '......';
//            }
//            else
//            {
//                $content = $model->content;
//            }
//        ?>
        <?= \yii\helpers\Markdown::process($model->content); ?>
        </p>
    </div>
    <nav class="navbar navbar-default" role="navigation">
        <p><b>标签:  </b>
        <?php
        $tags = explode(',', $model->tags);
        foreach($tags as $tag)
        {
            echo $tag, ' ';
        }
        ?>
        </p>
        <p><?php echo Html::a("Comments ({$model->commentCount})",$model->url.'#comments'); ?> |
        Last updated on <?php echo date('F j, Y',$model->updated_at); ?></p>
    </nav>
</div>

