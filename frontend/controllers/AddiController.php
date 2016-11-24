<?php

namespace frontend\controllers;

use Yii;
use common\models\Addi;
use yii\filters\Cors;

class AddiController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => Cors::className(),
                'cors' => [
                    // restrict access to
                    'Origin' => ['*'],
                    // 'Access-Control-Request-Method' => ['POST', 'GET'],
                    // // Allow only POST and PUT methods
                    // 'Access-Control-Request-Headers' => ['X-Wsse'],
                    // // Allow only headers 'X-Wsse'
                    // 'Access-Control-Allow-Credentials' => true,
                    // // Allow OPTIONS caching
                    // 'Access-Control-Max-Age' => 3600,
                ],

            ],
        ];
    }

    public function actionAjaxGetCitys()
    {
        $provinceId = Yii::$app->request->get('id');
        if ($provinceId) {
            $citys = Addi::getCitys($provinceId);
            return json_encode($citys);
        }else{
            return json_encode(['error' => '参数错误']);
        }
    }

}
