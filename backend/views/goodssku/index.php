<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GoodsskuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '产品档案';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goodssku-index">


    <p>
        <?= Html::a('创建产品', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'header' => '操作'
            ],
            'sku',
            'declared_value',
            'currency_code',
            'old_sku',
            'is_quantity_check',
            'contain_battery',
            'qty_of_ctn',
            'ctn_length',
            'ctn_width',
            'ctn_height',
            'ctn_fact_weight',
            'sale_company',
            'vendor_code',
            'origin_code',
            'min_order_num',
            'pd_get_days',
            'pd_costprice_code',
            'pd_costprice',
            'bill_name',
            'bill_unit',
            'brand',
            'sku_mark',
            //'pur_info_id',

        ],
    ]); ?>
</div>
