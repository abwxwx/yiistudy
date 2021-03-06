<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tb_tag".
 *
 * @property integer $id
 * @property string $name
 * @property integer $frequency
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['frequency'], 'integer'],
            [['name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'frequency' => 'Frequency',
        ];
    }

    public static function string2array($tags)
    {
        return preg_split('/\s*,\s*/',trim($tags),-1,PREG_SPLIT_NO_EMPTY);
    }

    public static function array2string($tags)
    {
        return implode(', ',$tags);
    }

    public static function updateFrequency($oldTags, $newTags)
    {
        $oldTags=self::string2array($oldTags);
        $newTags=self::string2array($newTags);
        self::addTags(array_values(array_diff($newTags,$oldTags)));
        self::removeTags(array_values(array_diff($oldTags,$newTags)));
    }

    public static function addTags($tags)
    {
        self::updateAllCounters(['frequency'=>1], ['in', 'name', $tags]);
        foreach($tags as $name)
        {
            if(!self::find()->where(['name'=>$name])->exists()) {
                $tag=new Tag;
                $tag->name=$name;
                $tag->frequency=1;
                $tag->save();
            }
        }
    }

    public static function removeTags($tags)
    {
        if(empty($tags)) {
            return;
        }
        self::updateAllCounters(['frequency'=>-1],['in', 'name', $tags]);
        self::deleteAll('frequency<=0');
    }

    public static function findTagWeights($maxTags = 20) {
//        $tags = Yii::$app->cache->get('Tag.findTagWeights_'.$maxTags);
//        if($tags === false) {
        $tags = self::find()->select('frequency')->orderBy('frequency DESC')->limit($maxTags)->indexBy('name')->column();

        if(empty($tags)) {
            return array();
        }

        $total = array_sum($tags);
        foreach($tags as $tag=>$frequency) {
            //$tags[$tag]=8+(int)(16*$frequency/($total+10));
            $tags[$tag]=18;//网站初创阶段，让字体统一大些
        }
//            Yii::$app->cache->set('Tag.findTagWeights_'.$maxTags, $tags, 3600);
//        }

        return $tags;
    }
}
