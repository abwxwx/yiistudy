<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\components\Ueditor;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'content')->widget(Ueditor::className(),[
        'options'=>[
            //'focus'=>true,//初始化时，是否让编辑器获得焦点true或false
            'toolbars'=> [
                ['bold', 'italic', 'underline', '|', 'subscript', 'superscript', '|', 'emotion', 'spechars', 'pasteplain', 'selectall',
                    'insertcode', 'inserttable', 'simpleupload', 'fullscreen'],
                ['formatmatch', 'fontfamily', 'fontsize', '|','insertorderedlist', 'insertunorderedlist','|', 'justifyleft',
                    'justifyright', 'justifycenter','|', 'imageleft', 'imageright', 'imagecenter'],
            ],
            'elementPathEnabled' => false,
            'wordCount' => false,
        ],
        'attributes'=>[
            'style'=>'height:240px'
        ]
    ]) ?>

    <?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '发布' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id' => 'publish']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
