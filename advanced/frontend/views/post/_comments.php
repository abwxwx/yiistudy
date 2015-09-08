<?php
use yii\helpers\Html;
use common\models\Member;
?>

<?php foreach($comments as $comment): ?>
<div class="comment" id="c<?php echo $comment->id; ?>">
    <br/>
    <hr>
    <div class="author">
        <?php echo Member::getAuthorLink($comment->user_id) ?>    <em><?php echo date('Y年 n月 j日  G:i',$comment->created_at); ?></em>
        <br/>
    </div>

    <div>
        <br/>
<!--        --><?php //echo nl2br(Html::encode($comment->content)); ?>
        <?php echo nl2br($comment->content); ?>

        <div>
            <a class="btn pull-right" type="button">回复</a>
        </div>
    </div>
</div>
<?php endforeach; ?>





