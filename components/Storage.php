<?php


namespace app\components;


use yii\base\Component;
use app\components\interfaces\StorageInterface;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use Yii;
use Intervention\Image\ImageManager;

class Storage extends Component implements StorageInterface
{

    private $fileName;

    /**
     * @param UploadedFile $file
     * @return mixed
     */
    public function saveUploadedFile(UploadedFile $file)
    {
        $path = $this->preprePath($file);

        if($path && $file->saveAs($path))
        {
            return $this->fileName;
        }
    }

    public function deleteUploadedFile($url)
    {
        if($url){
            $url = Yii::getAlias('@app').'/web/img/uploads/'.$url;

            if(file_exists($url))
            {
               if(unlink($url))
               {
                   return true;
               }
            }else{
                return false;
            }
        }else{
            return false;
        }

    }


    protected function preprePath(UploadedFile $file)
    {
        $this->fileName = $this->getFileName($file);

        $path = $this->getStoragePath().$this->fileName;

        $path = FileHelper::normalizePath($path);
        if(FileHelper::createDirectory(dirname($path)))
        {
            return $path;
        }
    }

    protected function getStoragePath()
    {
        return Yii::getAlias(Yii::$app->params['storagePath']);
    }

    protected function getFileName(UploadedFile $file)
    {
        //$this->resizePicture($file->tempName);
        $hash = sha1_file($file->tempName);

        $name = substr_replace($hash, '/',2,0);
        $name = substr_replace($name, '/',5,0);

        return $name.'.'.$file->extension;
    }

    protected function resizePicture($tempName)
    {
        $manager = new ImageManager(['driver'=>'imagick']);

        $image = $manager->make($tempName);

        $image->resize(Yii::$app->params['postPicture']['maxWidth'],Yii::$app->params['postPicture']['maxHeight'],function($constraint){
            $constraint->aspectRatio();
            $constraint->upSize();
        })->save($tempName, 90);
    }
}