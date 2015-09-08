<?php

use \yii\helpers\Html;
use common\models\Comment;
?>


<ul class="nav nav-pills nav-stacked">
<li class="active"><?php echo Html::a('Create New Post',['post/create'], [ 'class'=>"list-group-item"]); ?></li>
<li><?php echo Html::a('Manage Posts',['post/admin'], [ 'class'=>"list-group-item"]); ?></li>
    <li><?php echo Html::a('Approve Comments' . ' (' . Comment::getPendingCommentCount() . ')',['comment/index'], [ 'class'=>"list-group-item"]); ?></li>
    <li><?php echo Html::a('Logout',['site/logout'], [ 'class'=>"list-group-item"]); ?></li>
</ul>