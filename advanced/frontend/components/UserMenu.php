<?php

namespace frontend\components;



use yii\helpers\Html;

class UserMenu extends Portlet  {
    /* public function init()
    {
        //$this->title=\Yii::t('app', "你好，{username}", ['username'=>Html::encode(\Yii::$app->user->identity->username)]);
        parent::init();
    }
*/
    protected function renderContent()
    {
        echo $this->render('userMenu');
    }
} 