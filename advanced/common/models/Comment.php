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


    public function save($runValidation = true, $attributeNames = NULL)
    {
        $this->user_id = Yii::$app->getUser()->id;
        $this->created_at = time();
        //$this->content = strip_tags($this->content); //去掉html标签
        parent::save($runValidation, $attributeNames);
    }

}
