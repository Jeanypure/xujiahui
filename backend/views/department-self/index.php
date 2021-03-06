<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use kartik\daterange\DateRangePicker;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\DepartmentSelfSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '部门产品lists');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pur-info-index">

    <h6><?= Html::encode($this->title) ?></h6>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',

                'template'=> ' {view} '
            ],
            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => '图片',
                'content' => function ($model, $key, $index, $column){
                    return "<img src='" .$model->pd_pic_url. "' width='100' height='100'>";


                }
            ],


            'purchaser',
            'pur_group',
            'pd_sku',
            [
                'attribute'=>'pd_title',
                'value' => function($model) { return $model->pd_title;},
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'headerOptions' => [
                    'width'=>'80%'
                ],
            ],
            [
                'attribute'=>'pd_title_en',
                'value' => function($model) { return $model->pd_title_en;},
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'headerOptions' => [
                    'width'=>'80%'
                ],
            ],

            [
                'attribute'=>'master_result',
                'value' => function($model) {
                    if($model->master_result==0){
                        return '拒绝';
                    }elseif($model->master_result==1){
                        return '采样';

                    }elseif($model->master_result==2){
                        return '需议价和谈其他条件';

                    }elseif($model->master_result==3){
                        return '尚未评';

                    }elseif($model->master_result==4){
                        return '直接下单';

                    }elseif($model->master_result==5){
                        return '季节产品推迟';

                    }
                },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['0' => '拒绝', '1' => '采样', '2' => '需议价和谈其他条件', '3' => '尚未评', '4' => '直接下单', '5' => '季节产品推迟'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'评审状态'],
            ],
            [
                'attribute'=>'is_purchase',
                'width'=>'50px',
                'value'=>function ($model, $key, $index, $widget) {
                    if($model->is_purchase==1){//0 不采购 1采购 2 未决定
                        return '采购';

                    }elseif($model->is_purchase==2){
                        return '未决定';
                    }else{
                        return '不采购';
                    }
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>[1 => '采购', 0 => '不采',2=>'未决定'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'采购?'],
            ],
            [
                'attribute'=>'master_mark',
                'value' => function($model) { return $model->master_mark;},
                'contentOptions'=> ['style' => 'width: 90%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'headerOptions' => [
                    'width'=>'90%'
                ],
            ],
            [
                'attribute' => 'purchaser_send_time',
                'headerOptions' => ['width' => '12%'],
                'filter' => DateRangePicker::widget([
                    'name' => 'DepartmentSelfSearch[purchaser_send_time]',
                    'value' => Yii::$app->request->get('DepartmentSelfSearch')['purchaser_send_time'],
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'locale' => [
                            'format' => 'Y-m-d H:i:s',
                            'separator' => '/',
                        ]
                    ]
                ])
            ],

            [
                'attribute'=>'source',
                'width'=>'50px',
                'value'=>function ($model, $key, $index, $widget) {
                    if($model->source=='0'){
                        return '销售推荐';

                    }else{
                        return '自主开发';
                    }
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['1' => '自主开发', '0' => '销售推荐'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'产品来源'],
                'group'=>true,  // enable grouping
            ],

//            'pd_package',
            'pd_length',
            'pd_width',
            'pd_height',
            [
                'attribute'=>'is_huge',
                'width'=>'100px',
                'value'=>function ($model, $key, $index, $widget) {
                    if($model->is_huge==1){
                        return '是';

                    }else{
                        return '否';
                    }
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['1' => '是', '0' => '否'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'是否大件'],
                'group'=>true,  // enable grouping
            ],
            'pd_weight',
            'pd_throw_weight',
            'pd_count_weight',
//            'pd_material',
            'pd_purchase_num',
            'pd_pur_costprice',
            'has_shipping_fee',
            'bill_type',
            'hs_code',
            'bill_tax_rebate',
            'bill_rebate_amount',
            'no_rebate_amount',
            'retail_price',
            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => 'Amazon链接',
                'content' => function ($model, $key, $index, $column){
                    if (!empty($model->amazon_url)) return "<a href='$model->amazon_url' target='_blank'>".parse_url($model->amazon_url)['host']."</a>";
                }
            ],
            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => 'eBay链接',
                'content' => function ($model, $key, $index, $column){
                    if (!empty($model->ebay_url)) return "<a href='$model->ebay_url' target='_blank'>".parse_url($model->ebay_url)['host']."</a>";
                }
            ],
            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => '1688链接',
                'content' => function ($model, $key, $index, $column){
                    if (!empty($model->url_1688)) return "<a href='$model->url_1688' target='_blank'>".parse_url($model->url_1688)['host']."</a>";
                }
            ],
            'shipping_fee',
            'oversea_shipping_fee',
            'transaction_fee',
            'gross_profit',
//            'remark',


        ],
    ]); ?>

</div>
