<?php

namespace backend\modules\bargain\controllers;

use Yii;
use  yii\web\Controller;
use linslin\yii2\curl;
use backend\modules\bargain\models\VendorDetail;
class ObtainDataController extends Controller
{
    public function action()
    {
        return [
            'error' =>[
                'class' => 'yii\web\ErrorAction'
            ]
        ];
    }
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * cURL GET example
     */
    public  function  actionGetExample()
    {
        //Init curl
        $curl = new curl\Curl();
        $url = 'https://5151251.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=176&deploy=1';
        $params = '';
        $response = $curl->get($url,$params);

    }

    /**
     * @return mixed
     * m获取最新请购列表
     */

    public function  actionToList(){
       $url = 'https://5151251.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=176&deploy=1';
       $result = $this->actionDoCurl($url);
       $requisition_arr = json_decode($result,true);
       if($requisition_arr['message']=='OK'&&$requisition_arr['code']==0){
           $arr_set = [];
           foreach ($requisition_arr['list'] as $key=>$value){
                   $arr = [] ;
                   $arr[] = $value['id'];
                   $arr[] = $value['columns']['trandate'];
                   $arr[] = $value['columns']['tranid'];
                   $arr[] = $value['columns']['entity']['name'];
                   $arr_set[] = $arr;
                   unset($arr);

           }

           $table = 'requisition_list';
           $arr_key = [
               'internal_id',
               'requisition_date',
               'document_number',
               'requisition_name'
           ];
           $truncateTab = Yii::$app->db2->createCommand('truncate table requisition_list')->execute();
           $response = Yii::$app->db2->createCommand()->batchInsert($table,$arr_key,$arr_set)->execute();
          return $response;

       }
    }

    public  function actionDoCurl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER,[
                'Authorization: NLAuth nlauth_account=5151251, nlauth_email=jenny.li@yaemart.com, nlauth_signature=Jenny666666, nlauth_role=1013',
                'Content-Type: application/json',
                'Accept: application/json'
        ]);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,2);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch, CURLOPT_URL, $url);
        ob_start();
        curl_exec($ch);
        $result = ob_get_contents();
        ob_end_clean();
        curl_close($ch);
        return $result;
    }

    /**
     * 获取最新供应商列表
     */
    public function actionGetVendorList(){
        $url = 'https://5151251.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=180&deploy=1';
        $result = $this->actionDoCurl($url);
        $resultArr = json_decode($result,true);
        if(!empty($resultArr)){
            $vendorList = [];
            foreach($resultArr as $key=>$value){
               $vendor['internal_id'] = $value['id'];
               $vendor['vendor_code'] = $value['values']['entityid'];
               $vendor['vendor_name'] = $value['values']['companyname'];
               $vendor['datecreated'] = $value['values']['datecreated'];
               $vendorList[] = $vendor;
            }
            $tbName = 'tb_vendor_list';
            $column = ['internal_id','vendor_code','vendor_name','datecreated'];
            $res = Yii::$app->db2->createCommand()->batchInsert($tbName,$column,$vendorList)->execute();
            return $res;
        }


    }

    /**
     * @param int $id
     * 获取供应商明细
     */
    public function actionGetVendorDetail($id = 47191){
        $url = "https://5151251.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=154&deploy=2&recordtype=Vendor&id=".$id;
        $res = $this->actionDoCurl($url);


    }

    public function  actionMultiRequest($startTime=null,$endTime=null){
        //获取 id/
//        $sql = "SELECT internal_id FROM tb_vendor_list WHERE datecreated BETWEEN '2018-08-01 00:00:00' AND '2018-08-30 23:59:59' limit 1,3;";
        $sql = "SELECT internal_id FROM tb_vendor_list WHERE internal_id NOT in (SELECT DISTINCT internalid FROM tb_vendor_detail);";
        $idSet = Yii::$app->db2->createCommand($sql)->queryAll();
        $ids = array_column($idSet,'internal_id');
        $multiCurl = [];
        $result = [];
        set_time_limit(0);
        $mh = curl_multi_init();
        foreach ($ids as $i=>$id){
            $url = 'https://5151251.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=154&deploy=2&recordtype=Vendor&id='.$id;
            $multiCurl[$i] = curl_init();
            curl_setopt($multiCurl[$i],CURLOPT_HTTPHEADER,['Authorization: NLAuth nlauth_account=5151251, nlauth_email=jenny.li@yaemart.com, nlauth_signature=Jenny666666, nlauth_role=1013',
                'Content-Type: application/json',
                'Accept: application/json']);
            curl_setopt($multiCurl[$i], CURLOPT_HEADER,0);
            curl_setopt($multiCurl[$i], CURLOPT_RETURNTRANSFER,1);
            curl_setopt($multiCurl[$i], CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($multiCurl[$i],CURLOPT_SSL_VERIFYHOST,2);
            curl_setopt($multiCurl[$i],CURLOPT_SSL_VERIFYPEER,false);
            curl_setopt($multiCurl[$i],CURLOPT_URL,$url);
            curl_multi_add_handle($mh, $multiCurl[$i]);
        }
        $active = null;
        //execute the handles
        do {
            $mrc = curl_multi_exec($mh, $active);
        } while ($mrc == CURLM_CALL_MULTI_PERFORM);
        while ($active && $mrc == CURLM_OK) {
            usleep(50000);
//             if (curl_multi_select($mh) != -1) {
            do {
                $mrc = curl_multi_exec($mh, $active);
            } while ($mrc == CURLM_CALL_MULTI_PERFORM);
//             }
        }


        foreach($multiCurl as $k =>$ch){
            $result[$k] = curl_multi_getcontent($ch);
            curl_multi_remove_handle($mh,$ch);
        }
        //close
        curl_multi_close($mh);

        return json_encode($result,true);
    }
    /**
     * 插入tb_vendor_detail表
     *
     */
    public function actionIntoVendorDetail(){
        $tbName = 'tb_vendor_detail';
        $column = ['internalid','supplier_code','supplier_name','contact_qq','contact_tel','contact_name','bill_type'];
        $startTime = '2018-08-01 00:00:00';
        $endTime = '2018-08-30 23:59:59';
        $result = $this->actionMultiRequest($startTime,$endTime);
        $recordArr = [];
        $res = json_decode($result,true);
        if(!empty($res)&&!array_key_exists('error',$res)){
            foreach ($res as $k=>$v){
                $value = json_decode($v,true);
                if(!array_key_exists('error',$value)) {
                    $record['internalid'] = $value['id'];
                    $record['supplier_code'] = $value['fields']['entityid'];
                    $record['supplier_name'] = $value['fields']['companyname'];
                    $record['contact_qq'] = $value['fields']['custentity_qq_number'];
                    $record['contact_tel'] = $value['fields']['phone'];
                    $record['contact_name'] = $value['fields']['custentity_attention'];
                    $record['bill_type'] = $value['fields']['custentity_invoice_type'];
                    $recordArr[] = $record;
                }
            }
        }
       /* foreach ($recordArr as $index =>$item){
            foreach ($item as $key=>$val){

                if(VendorDetail::updateAllCounters(['supplier_code' => $item['supplier_code']],
                    ['internalid'=>"$key"])){continue;}
                $data[] = [
                    'internalid' => $item['internalid'],
                    'supplier_code' => $item['supplier_code'],
                    'supplier_name' =>$item['supplier_name'],
                    'contact_qq' => $item['contact_qq'],
                    'contact_tel' => $item['contact_tel'],
                    'contact_name' => $item['contact_name'],
                    'bill_type' => $item['bill_type'],
                ];
            }
        }*/


            $response = Yii::$app->db2->createCommand()->batchInsert($tbName,$column,$recordArr)->execute();
            return $response;

    }





}
