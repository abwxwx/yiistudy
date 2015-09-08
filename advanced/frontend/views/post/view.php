<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-info">
    <div class="panel-heading">
        <h3><?= Html::encode($model->title); ?></h3>
    </div>
    <div class="panel-body">
        <?= \yii\helpers\Markdown::process($model->content); ?>
    </div>
    <div class="panel-footer">
        <h4><b>标签:   </b>
        <?php
        $tags = explode(',', $model->tags);
        foreach($tags as $tag)
        {
            echo $tag, ' ';
        }
        ?>
        </h4>
    </div>
</div>

<br/>
<br/>

<div>
    <p>共有<em><?php echo $model->commentCount; ?></em>条评论</p>

    <div class="post-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($commentmodel, 'content')->textarea(['rows' => 6]) ?>

        <div class="form-group">
            <?= Html::submitButton('提交评论', ['class' =>'btn btn-success pull-right']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>

<br/>
<br/>

<hr style="height:3px;background-color:#b9def0;" />

<div id="comment">
    <?php if($model->commentCount>=1): ?>
        <?php echo $this->render('_comments',[
            'post'=>$model,
            'comments'=>$model->comments,
        ]); ?>
    <?php endif; ?>
</div>




