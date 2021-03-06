<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PurInfo;

/**
 * JuniorCompleteSearch represents the model behind the search form of `backend\models\PurInfo`.
 */
class JuniorCompleteSearch extends PurInfo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pur_complete_status','junior_submit','pur_info_id', 'pur_group', 'is_huge', 'pd_purchase_num', 'has_shipping_fee',  'bill_tax_rebate', 'parent_product_id', 'source', 'preview_status', 'brocast_status', 'is_submit', 'is_submit_manager', 'pur_group_status'], 'integer'],
            [['purchaser', 'pd_title', 'pd_title_en', 'pd_pic_url', 'pd_package', 'pd_length', 'pd_width', 'pd_height', 'pd_material', 'bill_type', 'hs_code', 'bill_rebate_amount', 'no_rebate_amount', 'retail_price', 'ebay_url', 'amazon_url', 'url_1688', 'else_url', 'shipping_fee', 'oversea_shipping_fee', 'transaction_fee', 'gross_profit', 'remark', 'member', 'master_member', 'master_mark', 'master_result', 'priview_time', 'pd_create_time', 'purchaser_leader'], 'safe'],
            [['pd_weight', 'pd_throw_weight', 'pd_count_weight', 'pd_pur_costprice', 'ams_logistics_fee'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {

        $username = Yii::$app->user->identity->username;
        $role = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        if(array_key_exists('超级管理员',$role)||array_key_exists('审核组',$role)){
            $query = PurInfo::find();

        }else{
            $query = PurInfo::find()->andWhere(['purchaser'=>$username]);
        }

        $this->source = 0;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'pur_info_id' => $this->pur_info_id,
            'pur_group' => $this->pur_group,
            'junior_submit' => $this->junior_submit,
            'is_huge' => $this->is_huge,
            'pd_weight' => $this->pd_weight,
            'pd_throw_weight' => $this->pd_throw_weight,
            'pd_count_weight' => $this->pd_count_weight,
            'pd_purchase_num' => $this->pd_purchase_num,
            'pd_pur_costprice' => $this->pd_pur_costprice,
            'has_shipping_fee' => $this->has_shipping_fee,
            'bill_tax_rebate' => $this->bill_tax_rebate,
            'parent_product_id' => $this->parent_product_id,
            'source' => $this->source,
            'preview_status' => $this->preview_status,
            'brocast_status' => $this->brocast_status,
            'priview_time' => $this->priview_time,
            'ams_logistics_fee' => $this->ams_logistics_fee,
            'is_submit' => $this->is_submit,
            'pd_create_time' => $this->pd_create_time,
            'is_submit_manager' => $this->is_submit_manager,
            'pur_group_status' => $this->pur_group_status,
            'pur_complete_status' => $this->pur_complete_status,

        ]);

        $query->andFilterWhere(['like', 'purchaser', $this->purchaser])
            ->andFilterWhere(['like', 'pd_title', $this->pd_title])
            ->andFilterWhere(['like', 'pd_title_en', $this->pd_title_en])
            ->andFilterWhere(['like', 'pd_pic_url', $this->pd_pic_url])
            ->andFilterWhere(['like', 'pd_package', $this->pd_package])
            ->andFilterWhere(['like', 'pd_length', $this->pd_length])
            ->andFilterWhere(['like', 'pd_width', $this->pd_width])
            ->andFilterWhere(['like', 'pd_height', $this->pd_height])
            ->andFilterWhere(['like', 'pd_material', $this->pd_material])
            ->andFilterWhere(['like', 'bill_type', $this->bill_type])
            ->andFilterWhere(['like', 'hs_code', $this->hs_code])
            ->andFilterWhere(['like', 'bill_rebate_amount', $this->bill_rebate_amount])
            ->andFilterWhere(['like', 'no_rebate_amount', $this->no_rebate_amount])
            ->andFilterWhere(['like', 'retail_price', $this->retail_price])
            ->andFilterWhere(['like', 'ebay_url', $this->ebay_url])
            ->andFilterWhere(['like', 'amazon_url', $this->amazon_url])
            ->andFilterWhere(['like', 'url_1688', $this->url_1688])
            ->andFilterWhere(['like', 'else_url', $this->else_url])
            ->andFilterWhere(['like', 'shipping_fee', $this->shipping_fee])
            ->andFilterWhere(['like', 'oversea_shipping_fee', $this->oversea_shipping_fee])
            ->andFilterWhere(['like', 'transaction_fee', $this->transaction_fee])
            ->andFilterWhere(['like', 'gross_profit', $this->gross_profit])
            ->andFilterWhere(['like', 'remark', $this->remark])
            ->andFilterWhere(['like', 'member', $this->member])
            ->andFilterWhere(['like', 'master_member', $this->master_member])
            ->andFilterWhere(['like', 'master_mark', $this->master_mark])
            ->andFilterWhere(['like', 'master_result', $this->master_result])
            ->andFilterWhere(['like', 'purchaser_leader', $this->purchaser_leader]);

        return $dataProvider;
    }
}
