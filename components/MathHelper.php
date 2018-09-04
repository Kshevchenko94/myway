<?php

namespace app\components;

use yii\base\Component;

class MathHelper extends Component
{

    public static function getProcent(array $params)
    {
        return ($params['number']*100)/$params['fromNumber'];
    }

    public static function countDays($data)
    {

    }

}