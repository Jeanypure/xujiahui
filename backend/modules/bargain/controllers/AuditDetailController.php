<?php

namespace backend\modules\bargain\controllers;

use Yii;
use backend\modules\bargain\models\RequisitionDetail;
use backend\modules\bargain\models\RequisitionDetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AuditDetailController implements the CRUD actions for RequisitionDetail model.
 */
class AuditDetailController extends Controller
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
     * Lists all RequisitionDetail models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RequisitionDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RequisitionDetail model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RequisitionDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RequisitionDetail();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RequisitionDetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing RequisitionDetail model.
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
     * Finds the RequisitionDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RequisitionDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RequisitionDetail::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * 同步更新请购单
     */
    public function  actionPostItem($id){
    $model = $this->findModel($id);
    $record = [];
    $record['id'] = $model->tran_internal_id;
    $record['tranid'] = $model->tranid;
    $externalItems = [];
    $lineItem['description']  = $model->description;
    $internalItem['internalid'] = $model->item_internal_id;
    $internalItem['name'] = $model->item_name;
    $lineItem['custcol_after_bargain'] = $model->after_bargain_price;
    $lineItem['item']  = $internalItem;
    $externalItems[] = $lineItem;
    $record['item'] = $externalItems;
    $itemArr = json_encode($record,true);
    $result = $this->actionDoCurl($itemArr);
        if($result==$model->tran_internal_id){
            return 'success!';
        }

    }
    /**
     * @param $item_arr
     * @return string
     * @throws \Exception
     */
    public  function  actionDoCurl($item_arr){

        try{
            $url = ' https://5151251.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=176&deploy=3';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization: NLAuth nlauth_account=5151251, nlauth_email=jenny.li@yaemart.com, nlauth_signature=Jenny666666, nlauth_role=1013',
                'Content-Type: application/json',
                'Accept: application/json'
            ));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,2);
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($item_arr));
            ob_start();
            curl_exec($ch);
            $result = ob_get_contents();
            ob_end_clean();
            curl_close($ch);
            return $result;
        }catch (\Exception $exception){
            throw $exception;
        }


    }
}