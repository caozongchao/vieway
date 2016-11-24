<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;

class SearchController extends Controller{

    public function actionIndex(){
        $db = Yii::$app->xunsearch->getDatabase('view');
        // $db = Yii::$app->xunsearch('duanzi');
        $xs = $db->xs;
        $search = $db->getSearch();
        $index = $db->getIndex();
        $key = Yii::$app->request->get('key');
        // $results = $search->search($key);
        $pages = new Pagination(['totalCount'=>$search->count($key)]);
        $results = $search->setQuery($key)->setLimit($pages->limit,$pages->offset)->search();
        return $this->render('index',['views'=>$results,'pages'=>$pages]);
    }
}
