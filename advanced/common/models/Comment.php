<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tb_comment".
 *
 * @property integer $id
 * @property string $content
 * @property integer $user_id
 * @property integer $post_id
 * @property integer $created_at
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'required'],
            [['content'], 'string'],
            [['user_id', 'post_id', 'created_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
//        return [
//            'id' => 'ID',
//            'content' => 'Content',
//            'user_id' => 'User ID',
//            'post_id' => 'Post ID',
//            'url' => 'Url',
//            'create_time' => 'Create Time',
//        ];
        return [
            'content' => Yii::t('app', '您的评价'),
        ];
    }

    /*制作盖楼式评论，整合评论内容*/
    public function dealContent($post)
    {
        $this->content = strip_tags($this->content); //去掉html标签
        if(!isset($post['replaytext']))
        {
            return true;
        }

        $lastcontent='';
        $precontent='';
        $content = $post['replaytext'];
        $count = substr_count($content, 'pull-right')+1;
        $pos = strrpos($content, '</div>');
        if($pos === false)
        {
            $lastcontent = $content;
        }
        else
        {
            $precontent = substr($content, 0, $pos+6);
            $lastcontent = substr($content, $pos+6);
        }

        $this->content = "<div class='replaydiv'>$precontent<span class='replayauthor'>".$post['replayname']."的原贴： </span>"."<span class='pull-right'>$count</span><p>$lastcontent</p></div>".$this->content;

        //数据库该字段为text,防止越界
        if(strlen($this->content) > 65535)
        {
            $this->content="";//防止评论失败时，将拼接好的信息回写评论文本框
            return false;
        }
        return true;
    }


    public function save($runValidation = true, $attributeNames = NULL)
    {
        $this->user_id = Yii::$app->getUser()->id;
        $this->created_at = time();
        //$this->content = strip_tags($this->content); //去掉html标签
        parent::save($runValidation, $attributeNames);
    }

}
