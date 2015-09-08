<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = '发布新日志';
$this->params['breadcrumbs'][] = ['label' => '日志', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">

    <h1><?= Html::encode($this->title) ?></h1>
<br/>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
