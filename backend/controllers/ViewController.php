<?php

namespace backend\controllers;

use Yii;
use common\models\View;
use backend\models\ViewSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\models\UploadForm;
use Imagine\Image\ManipulatorInterface;
use yii\imagine\Image;
use common\helpers\CurlHelper;
use yii\helpers\Url;

/**
 * ViewController implements the CRUD actions for View model.
 */
class ViewController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all View models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ViewSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single View model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new View model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new View();
        $uploadForm = new UploadForm();
        $uploadForm->setScenario('new');

        if ($model->load(Yii::$app->request->post())) {
            $uploadForm->imgs = UploadedFile::getInstances($uploadForm, 'imgs');
            $imgPath = $uploadForm->doUpload($uploadForm->imgs);
            $model->img = $imgPath[1];
            $result = Yii::$app->qiniu->putFile(strstr($imgPath[0], 'uploads'),$imgPath[0]);
            unlink($imgPath[0]);
            $uploadForm->scan_img = UploadedFile::getInstance($uploadForm, 'scan_img');
            $scanImgPath = $uploadForm->doUpload($uploadForm->scan_img);
            $model->scan_img = $scanImgPath[1];
            Image::thumbnail($scanImgPath[0],580,386,ManipulatorInterface::THUMBNAIL_OUTBOUND)->save($scanImgPath[0]);
            $result = Yii::$app->qiniu->putFile(strstr($scanImgPath[0], 'uploads'),$scanImgPath[0]);
            unlink($scanImgPath[0]);
            $model->save();
            $postData = [Yii::$app->params['hostUrl'].$model->id.'.html'];
            $api = 'http://data.zz.baidu.com/urls?site=www.vieway.cn&token=30TdOLMMaCn491L0';
            CurlHelper::baiduPost($api,$postData);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'uploadForm' => $uploadForm,
            ]);
        }
    }

    /**
     * Updates an existing View model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $uploadForm = new UploadForm();
        $uploadForm->setScenario('update');

        if ($model->load(Yii::$app->request->post())) {
            $uploadForm->imgs = UploadedFile::getInstances($uploadForm, 'imgs');
            if ($uploadForm->imgs) {
                $uploadForm->imgs = UploadedFile::getInstances($uploadForm, 'imgs');
                $imgPath = $uploadForm->doUpload($uploadForm->imgs);
                $model->img = $imgPath[1];
                $result = Yii::$app->qiniu->putFile(strstr($imgPath[0], 'uploads'),$imgPath[0]);
                unlink($imgPath[0]);
            }
            $uploadForm->scan_img = UploadedFile::getInstance($uploadForm, 'scan_img');
            if ($uploadForm->scan_img) {
                $scanImgPath = $uploadForm->doUpload($uploadForm->scan_img);
                $model->scan_img = $scanImgPath[1];
                Image::thumbnail($scanImgPath[0],580,386,ManipulatorInterface::THUMBNAIL_OUTBOUND)->save($scanImgPath[0]);
                $result = Yii::$app->qiniu->putFile(strstr($scanImgPath[0], 'uploads'),$scanImgPath[0]);
                unlink($scanImgPath[0]);
            }
            $model->save();
            // $postData = [Yii::$app->params['hostUrl'].$model->id.'.html'];
            // $api = 'http://data.zz.baidu.com/urls?site=www.vieway.cn&token=30TdOLMMaCn491L0';
            // CurlHelper::baiduPost($api,$postData);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'uploadForm' => $uploadForm,
            ]);
        }
    }

    /**
     * Deletes an existing View model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the View model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return View the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = View::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
