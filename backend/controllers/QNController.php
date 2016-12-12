<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class QNController extends Controller
{
    public function actionIndex()
    {
        $dir = Yii::getAlias('@frontend').'/web/uploads';
        $this->doUpload($dir);
    }

    public function doUpload($dir)
    {
        if (is_dir($dir)) {
            if ($handle = opendir($dir)) {
                while (($file = readdir($handle)) !== false) {
                    if($file != '.' && $file != '..'){
                        if (is_dir($dir.'/'.$file)) {
                            $this->doUpload($dir.'/'.$file);
                        }else{
                            $result = Yii::$app->qiniu->putFile(strstr($dir.'/'.$file, 'uploads'),$dir.'/'.$file);
                        }
                    }
                }
            }
        }
    }
}
