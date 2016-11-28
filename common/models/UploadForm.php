<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "view".
 *
 * @property integer $id
 * @property string $name
 * @property integer $province
 * @property integer $city
 * @property integer $level
 */
class UploadForm extends \yii\base\model
{
    public $imgs;
    public $scan_img;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['imgs'], 'file','skipOnEmpty' => false,'maxFiles' => 0,'on' => 'new'],
            [['imgs'], 'file','maxFiles' => 0,'on' => 'update'],
            [['scan_img'], 'file','skipOnEmpty' => false,'maxFiles' => 1,'on' => 'new'],
            [['scan_img'], 'file','maxFiles' => 1,'on' => 'update'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'imgs' => '导游图',
            'scan_img' => '标志图',
        ];
    }

    public function doUpload($instance)
    {
        $imgPath = '';
        $dir = dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR.'frontend'.DIRECTORY_SEPARATOR.'web'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.date('Y').DIRECTORY_SEPARATOR.date('m').DIRECTORY_SEPARATOR.date('d').DIRECTORY_SEPARATOR;
        $this->create_folders($dir);
        if (is_array($instance)) {
            foreach ($instance as $img) {
                $extension = strstr($img->name, '.');
                $name = $dir.date('Ymd').rand(10000,99999).$extension;
                $imgPath = $imgPath == '' ? $name : $imgPath.','.$name;
                $img->saveAs($name);
            }
        }else{
            $extension = strstr($instance->name, '.');
            $name = $dir.date('Ymd').rand(10000,99999).$extension;
            $imgPath = $imgPath == '' ? $name : $imgPath.','.$name;
            $instance->saveAs($name);
        }
        $array = explode(DIRECTORY_SEPARATOR, $imgPath);
        $index = array_search('uploads', $array);
        $arrayNew = array_slice($array, $index);
        $imgPathNew = implode(DIRECTORY_SEPARATOR, $arrayNew);
        return [$imgPath,$imgPathNew];
    }

    public function create_folders($dir){
        return is_dir($dir) or ($this->create_folders(dirname($dir)) and mkdir($dir) and chmod($dir,0777));
    }
}
