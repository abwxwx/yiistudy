<?php
namespace frontend\components;
use Yii;
use yii\web\AssetBundle;

class UeditorAsset extends AssetBundle
{
    public $js = [
        'ueditor.config.js',
        'ueditor.all.js',
    ];
    public $css = [
    ];
    public function init()
    {
        $this->basePath = $_SERVER['DOCUMENT_ROOT'].\Yii::getAlias('@web').'/ueditor'; //设置资源所处的目录
        $this->baseUrl = Yii::getAlias('@web').'/ueditor';
        //echo $this->baseUrl; die;
    }
}