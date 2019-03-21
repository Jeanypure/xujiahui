<?php

namespace backend\controllers;

use Yii;
use backend\models\PurInfo;
use backend\models\Sample;
use app\models\FinancialAgreestSearch;
//use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FinancialAgreestController implements the CRUD actions for PurInfo model.
 */
class FinancialAgreestController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all PurInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FinancialAgreestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PurInfo model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $pay_at = date('Y-m-d H:i:s');
        $sample_model = Sample::findOne(['sample_id'=>$id]);
        $model = PurInfo::findOne(['pur_info_id'=>$sample_model->spur_info_id]);
        if(isset($sample_model)&&!empty($sample_model)){
                if($sample_model->load(Yii::$app->request->post()) ){
                    $sample_model->has_pay = Yii::$app->request->post()['Sample']['has_pay'];
                    $sample_model->pay_at = $pay_at;
                    $sample_model->payer = Yii::$app->user->identity->username;
                    $sample_model->save(false);
                    return $this->redirect(['index']);
                }
            return $this->renderAjax('view', [
                'model' => $model,
                'sample_model' => $sample_model,
            ]);
        }else{
            return $this->render('view', [
                'model' => $model,
                'sample_model' => $sample_model,
            ]);
        }
    }

    public function actionFeeBack($id)
    {
        $sample_model = Sample::findOne(['spur_info_id'=>$id]);
        $model = $this->findModel($id);
          if($sample_model->load(Yii::$app->request->post()) ){
            $sample_model->fact_refund = Yii::$app->request->post()['Sample']['fact_refund'];
            $sample_model->has_refund = Yii::$app->request->post()['Sample']['has_refund'];
            $sample_model->sure_refund_men = Yii::$app->user->identity->username;
            $sample_model->sure_remark = Yii::$app->request->post()['Sample']['sure_remark'];
            $sample_model->save();
            return $this->redirect(['index']);

        }
        return $this->renderAjax('fee_back',[
            'model' => $model,
            'sample_model' => $sample_model
        ]);
    }



    /**
     * Creates a new PurInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PurInfo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pur_info_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PurInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pur_info_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PurInfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PurInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PurInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PurInfo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
