<?php


namespace backend\controllers;

use backend\models\Company;
use Yii;
use backend\models\PurInfo;
use backend\models\MangerAuditSearch;
use backend\models\JuniorAuditSearch;
use backend\models\Preview;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JuniorAuditController implements the CRUD actions for PurInfo model.
 */
class JuniorAuditController extends Controller
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
        $searchModel = new JuniorAuditSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     * @throws \yii\db\Exception
     */
    public function actionView($id)
    {

        $preview = Preview::find()
                    ->where(['product_id'=>$id])
                    ->andWhere(['<>','member2','Becky'])
                    ->one();
        $leader =  Yii::$app->db->createCommand("
                   select sub_company, leader from `company`
                   ")->queryAll();

        $data = [] ;
        foreach($leader as $key=>$value){
            $data[$value['sub_company']] = $value['leader'];
        }

        $model_update = Preview::find()
            ->where(['product_id'=>$id])
            ->andWhere(['member2' => 'Becky'])
            ->one();
        $exchange_rate = PurInfoController::actionExchangeRate();

        if($model_update->load(Yii::$app->request->post())) {
                $model_update->view_status = 1;
                $model_update->priview_time = date('Y-m-d H:i:s');
                $model_update->save(false);
//                return $this->redirect(['index']);
            }
            return $this->render('view', [
                'model' => $this->findModel($id),
                'preview' => $preview,
                'model_update' =>$model_update,
                'exchange_rate' =>$exchange_rate,
                'data' =>$data,
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

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
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

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            return $this->redirect(['view', 'id' => $model->pur_info_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
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


    /**
     * Manger Audit is the  final determination  what the product status
     */
    public function actionAudit( $id )
    {
        $model = $this->findModel($id);
        if($model){
            if ($model->load(Yii::$app->request->post())  ) {
                $model->master_result = Yii::$app->request->post()['PurInfo']['master_result'];
                $model->master_mark = Yii::$app->request->post()['PurInfo']['master_mark'];
                $model->master_member = Yii::$app->user->identity->username;
                $model->preview_status = 1;
                $model->save(false);
                return $this->redirect(['index']);
            }

            return $this->renderAjax('update_audit', [
                'model' => $model,
            ]);
        }

    }


    public function actionCheckSample($id){
        $spur_id = Yii::$app->db->createCommand("
                   select spur_info_id  from sample where spur_info_id = $id
                  ")->queryOne();

        return $spur_id['spur_info_id'];

    }

    /**
     * 按规则生成SKU
     *
     */
    public function actionBorn($id)
    {
        $model = $this->findModel($id);
        $res =   Yii::$app->db->createCommand("
             select sku_code1,start_num from purchaser where  purchaser= '$model->purchaser';
            ")->queryAll();
        $part1 =$res[0]['sku_code1'];
        $sku = $part1.'-';
        return $sku;

    }

}
