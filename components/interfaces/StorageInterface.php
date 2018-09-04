<?php

namespace app\components\interfaces;

use yii\web\UploadedFile;

interface StorageInterface
{
    public function saveUploadedFile(UploadedFile $file);
}