<?php

namespace app\assets;

class SweetAlertAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@bower/sweetalert2/dist';
    public $css = [
        'sweetalert2.css',
    ];
    public $js = [
        'sweetalert2.js',
        'sweetalert2.all.js',
    ];
}