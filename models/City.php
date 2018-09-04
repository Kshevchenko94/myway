<?php


namespace app\models;

use yii\base\Model;


class City extends Model
{
    public function searchCities($query)
    {
        //die(print_r('http://kladr-api.ru/api.php?contentType=city&withParent=1&'.http_build_query($query)));
        $ch = curl_init('http://kladr-api.ru/api.php?contentType=city&withParent=1&typeCode=1&'.http_build_query($query));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $res = curl_exec($ch);

        curl_close($ch);

        return $res;
    }
}