<?php

namespace app\assets;

class LightBox2Asset extends \yii\web\AssetBundle
{
    public $sourcePath = '@bower/lightbox2/dist';
    public $css = [
        'css/lightbox.css',
    ];
    public $js = [
        'js/lightbox.js',
    ];
}