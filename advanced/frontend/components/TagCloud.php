<?php

namespace frontend\components;

use common\models\Tag;
use yii\helpers\Html;


class TagCloud extends Portlet {
    public $title='热门标签';
    public $maxTags=20;

    protected function renderContent()
    {
        $tags=Tag::findTagWeights($this->maxTags);
//        $tags = ['test'=>14, 'sss'=>20];

        foreach($tags as $tag=>$weight)
        {
            $link=Html::a(Html::encode($tag), array('post/index','tags'=>$tag));
            echo Html::tag('span', $link, array(
                    'class'=>'label label-info',
                    'style'=>"font-size:{$weight}px",
                ) )."\n";
        }
    }
} 