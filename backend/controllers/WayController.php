<?php

namespace backend\controllers;

use Yii;
use common\models\Way;
use backend\models\WaySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\ViewDetail;

/**
 * WayController implements the CRUD actions for Way model.
 */
class WayController extends Controller
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
     * Lists all Way models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WaySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Way model.
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
     * Creates a new Way model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $viewId = Yii::$app->request->get('id');
        $viewDetails = ViewDetail::find()->select(['name'])->indexBy('id')->where(['view_id' => $viewId])->column();
        $model = new Way();

        if ($model->load(Yii::$app->request->post())) {
            $model->view_path = $_POST['Way']['view_path'];
            if (is_array($model->view_path)) {
                $model->view_path = implode(',', $model->view_path);
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'viewDetails' => $viewDetails,
                'viewId' => $viewId,
            ]);
        }
    }

    /**
     * Updates an existing Way model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $viewDetails = ViewDetail::find()->select(['name'])->indexBy('id')->where(['view_id' => $model->view_id])->column();

        if ($model->load(Yii::$app->request->post())) {
            $model->view_path = $_POST['Way']['view_path'];
            if (is_array($model->view_path)) {
                $model->view_path = implode(',', $model->view_path);
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            if (intval($model->view_path)) {
                $model->view_path = explode(',', $model->view_path);
            }
            return $this->render('update', [
                'model' => $model,
                'viewDetails' => $viewDetails,
                'viewId' => $model->view_id
            ]);
        }
    }

    /**
     * Deletes an existing Way model.
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
     * Finds the Way model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Way the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Way::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
