<?php
namespace frontend\components;


use common\models\Post;
use yii\base\Behavior;

class MailBehavior extends Behavior {

    public function events() {
        return [
            Post::EVENT_NEW_COMMENT => 'commentSubmit',
        ];
    }

    public function commentSubmit($event) {
//        var_dump($event->sender);die;
    }

    public function test() {
        return $this->owner->title;
    }
}