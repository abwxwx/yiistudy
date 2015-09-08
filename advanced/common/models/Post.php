<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;

/**
 * This is the model class for table "tb_post".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $content
 * @property string $tags
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'tags'], 'required'],
            [['user_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 128],
            [['tags'], 'string', 'max' => 256],
            [['tags'], 'normalizeTags']
        ];
    }


    /**
     * Normalizes the user-entered tags.
     */
    public function normalizeTags($attribute,$params)
    {
        $this->tags=Tag::array2string(array_unique(Tag::string2array($this->tags)));
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title' => Yii::t('app', '标题'),
            'content' => Yii::t('app', '内容'),
            'tags' => Yii::t('app', '标签 (多标签之间用逗号隔开)'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * 关联关系，获取作者信�?
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor() {
        return $this->hasOne(Member::className(), ['id' => 'user_id']);
    }

    /**
     * 关联关系，获取评论信息，按时间倒序排列
     * @return ActiveQuery
     */
    public function getComments() {
        return $this->hasMany(Comment::className(), ['post_id' => 'id'])
            ->orderBy(Comment::tableName().'.created_at DESC');
    }

    /**
     * 获取评论数量
     * @return int|string
     */
    public function getCommentCount() {
        return Comment::find()
            ->where(['post_id' => $this->id])
            ->count();
    }

    public function getUrl() {
        return Url::to(['post/view', 'id' => $this->id, 'title'=>$this->title]);
    }

    public function save($runValidation = true, $attributeNames = NULL)
    {
        $this->user_id = Yii::$app->getUser()->id;
        $this->status = 1; //后续可用此字段增加审核功能
        parent::save($runValidation, $attributeNames);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if(array_key_exists("tags", $changedAttributes)) {
            Tag::updateFrequency($changedAttributes['tags'], $this->tags);
        }
    }
}
