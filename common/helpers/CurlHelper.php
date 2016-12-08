<?php
namespace common\helpers;

use Yii;

class CurlHelper{

    public static function curlGet($url){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }

    public static function curlPost($url,$postData){
        // $postData = array ("username" => "bob","key" => "12345");
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        // curl_setopt($curl,  CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        // $Headers =  curl_getinfo($curl);
        // echo $Headers["url"];
        curl_close($curl);
        return $result;
    }

    public static function baiduPost($url,$postData){
        $ch = curl_init();
        $options =  array(
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => implode("\n", $postData),
            CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
        );
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        // return $result;
        file_put_contents('baiduPost.txt', $result."\n",FILE_APPEND);
    }
}