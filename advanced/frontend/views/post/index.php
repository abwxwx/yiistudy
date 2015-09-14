<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '日志';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <?= ListView::widget([
        'summary' => '',  //不显示统计信息
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => '_view'
            /*function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model->title), ['view', 'id' => $model->id]);
        },*/
    ]) ?>

</div>
