<?php
//use Yii;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Member;
?>

<style>
    .replaydiv{
        background-color: #f8f8f8;
        margin: 5px 2px;
        border: 1px solid #f8f8f8;
    }

    .replayspan{
        color: #0000ff;
        font-weight: bold;
        line-height: 2;
    }
</style>

<?php foreach($comments as $comment): ?>
<div class="comment" id="c<?php echo $comment->id; ?>">
    <br/>
    <hr />
    <div class="author">
        <?php echo Html::img('/bjstudy/yiistudy/advanced/frontend/web/images/default.jpg', ['width'=>50, 'height'=>50]);?>
        <?php  echo Html::decode(Member::getAuthorLink($comment->user_id)); ?> <em class="pull-right"><?php echo date('Y年 n月 j日  G:i',$comment->created_at); ?></em>
        <br/>
    </div>

    <div class="comment" style="padding:5px 50px">
        <br/>
<!--        --><?php //echo nl2br(Html::encode($comment->content)); ?>
        <?php echo nl2br($comment->content); ?>

        <div>
            <a class="btn pull-right" type="button">回复</a>
        </div>
        <br/>
        <br/>

        <form role="form" style="background-color:#f8f8f8;margin-top: 10px;display: none" action="<?php echo Url::to('');?>" method="post" >
            <div class="form-group" style="border: 1px solid #cccccc;height:70px">
                <input type="hidden" value="<?php echo Yii::$app->request->getCsrfToken(); ?>" name="_csrf" />
                <input type="hidden" name="replayname" value="<?php echo Member::getAuthorName($comment->user_id) ?>" />
                <input type="hidden" name="replaytext" value="<?php echo nl2br($comment->content); ?>" />
                <input type="text" style="background-color:#ffffff;border: 0" class="form-control" name=<?php echo $inputname;?>/>
                <input type="submit" id="recomment" class="btn btn-default pull-right" value="提交"/>
            </div>
        </form>
    </div>
</div>
<?php endforeach; ?>




