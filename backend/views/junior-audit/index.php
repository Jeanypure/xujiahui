<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\daterange\DateRangePicker;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\MangerAuditSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '杭州评审');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pur-info-index">

     <p>
            <?= Html::button('提交评审', ['id' => 'is_submit_manager', 'class' => 'btn btn-primary']) ;?>
            <?=  Html::button('取消提交', ['id' => 'un_submit_manager', 'class' => 'btn btn-info']) ?>

     </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'striped'=>true,
        'id' => 'junior-audit',
        'responsive'=>true,
        'hover'=>true,
        'export' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\CheckboxColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=> '操作',
                'template' => ' {view}',
                'headerOptions' => ['width' => '100'],

            ],
            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => '图片',
                'content' => function ($model, $key, $index, $column){
                    return "<img src='" .$model['pd_pic_url']. "' width='100' height='100'>";


                }
            ],
            'purchaser',
            [
                'attribute'=>'pur_group',
                'value' => function($model) {
                    if($model['pur_group']==1){
                        return '一部';
                    }elseif ($model['pur_group']==2){
                        return '二部';
                    }elseif ($model['pur_group']==3){
                        return '三部';
                    }elseif ($model['pur_group']==4){
                        return '四部';
                    }elseif ($model['pur_group']==5){
                        return '五部';
                    }elseif ($model['pur_group']==6){
                        return '六部';
                    }elseif ($model['pur_group']==7){
                        return '七部';
                    }elseif ($model['pur_group']==8){
                        return '八部';
                    }
                },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['1' => '一部', '2' => '二部','3' => '三部','4' => '四部','5' => '五部','6' => '六部','7' => '七部','8' => '八部',],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'部门'],
//                'group'=>true,  // enable grouping

            ],

            [
                'attribute'=>'pd_title',
                'value' => function($model) { return $model['pd_title'];},
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'headerOptions' => [
                    'width'=>'80%'
                ],
            ],
            [
                'attribute'=>'pd_title_en',
                'value' => function($model) { return $model['pd_title_en'];},
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'headerOptions' => [
                    'width'=>'80%'
                ],
            ],
            [
                'attribute'=>'audit_b',
                'width'=>'100px',
                'value'=>function ($model, $key, $index, $widget) {
                    if($model['audit_b']==1){
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
                'filterInputOptions'=>['placeholder'=>'是否提交'],
            ],
            [
                'attribute'=>'audit_a',
                'width'=>'100px',
                'value'=>function ($model, $key, $index, $widget) {
                    if($model['audit_a']==1){
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
                'filterInputOptions'=>['placeholder'=>'是否提交'],
            ],
            [
                'attribute'=>'audit_c',
                'width'=>'100px',
                'value'=>function ($model, $key, $index, $widget) {
                    if($model['audit_c']==1){
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
                'filterInputOptions'=>['placeholder'=>'是否提交'],
            ],
            [
                'attribute'=>'view_status',
                'value' => function($model) {
                    if($model->view_status==1){
                        return '已评审';
                    }else{
                        return '未评审';

                    }
                },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['0' => '未评审', '1' => '已评审'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'评审?'],
            ],
            [
                'attribute'=>'submit_manager',
                'value' => function($model) {
                    if($model->submit_manager==1){
                        return '是';
                    }else{
                        return '否';

                    }
                },
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['0' => '否', '1' => '是'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'提交?'],
//                'group'=>true,  // enable grouping

            ],
            [
                'attribute'=>'result',
                'value' => function($model) {
                    if($model->result==0){
                        return '拒绝';
                    }elseif($model->result==1){
                        return '采样';

                    }elseif($model->result==2){
                        return '需议价和谈其他条件';

                    }elseif($model->result==3){
                        return '尚未评';

                    }elseif($model->result==4){
                        return '直接下单';

                    }elseif($model->result==5){
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
                'filterInputOptions'=>['placeholder'=>'结果'],
            ],
            [
                'attribute'=>'master_result',
                'value' => function($model) {
                    if($model['master_result']==0){
                        return '拒绝';
                    }elseif($model['master_result']==1){
                        return '采样';

                    }elseif($model['master_result']==2){
                        return '需议价和谈其他条件';

                    }elseif($model['master_result']==3){
                        return '尚未评';

                    }elseif($model['master_result']==4){
                        return '直接下单';

                    }elseif($model['master_result']==5){
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
                'filterInputOptions'=>['placeholder'=>'评审结果'],
            ],
            [
                'attribute'=>'master_mark',
                'value' => function($model) { return $model['master_mark'];},
                'contentOptions'=> ['style' => 'width: 50%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
            ],
            [
                'attribute'=>'preview_status',
                'width'=>'100px',
                'value'=>function ($model, $key, $index, $widget) {
                    if($model['preview_status']==1){
                        return '已评审';

                    }else{
                        return '未评审';
                    }
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['1' => '已评审', '0' => '未评审'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'评审状态'],
            ],
            [
                'attribute' => 'pd_create_time',
                'headerOptions' => ['width' => '12%'],
                'filter' => DateRangePicker::widget([
                    'name' => 'MangerAuditSearch[pd_create_time]',
                    'value' => Yii::$app->request->get('MangerAuditSearch')['pd_create_time'],
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
//                'group'=>true,  // enable grouping
            ],

            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => 'Amazon链接',
                'content' => function ($model, $key, $index, $column){
                    if (!empty($model['amazon_url'])) return "<a href='$model[amazon_url]' target='_blank'>".parse_url($model['amazon_url'])['host']."</a>";
                }
            ],
            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => 'eBay链接',
                'content' => function ($model, $key, $index, $column){
                    if (!empty($model['ebay_url'])) return "<a href='$model[ebay_url]' target='_blank'>".parse_url($model['ebay_url'])['host']."</a>";
                }
            ],
            [
                'class' => 'yii\grid\Column',
                'headerOptions' => [
                    'width'=>'100'
                ],
                'header' => '1688链接',
                'content' => function ($model, $key, $index, $column){
                    if (!empty($model['url_1688'])) return "<a href='$model[url_1688]' target='_blank'>".parse_url($model['url_1688'])['host']."</a>";
                }
            ],


            'shipping_fee',
            'oversea_shipping_fee',
            'transaction_fee',
            'gross_profit',
            'profit_rate',
            'gross_profit_amz',
            'profit_rate_amz',
            [
                'attribute'=>'remark',
                'value' => function($model) { return $model['remark'];},
                'contentOptions'=> ['style' => 'width: 80%; word-wrap: break-word;white-space:pre-line;'],
                'format'=>'html',
                'headerOptions' => [
                    'width'=>'80%'
                ],
            ],
        ],
    ]); ?>


</div>


<?php
$submit = Url::toRoute('submit');
$unsubmit = Url::toRoute('cancel');
//提交评审
$is_submit_manager =<<<JS
    $('#is_submit_manager').on('click',function() {
            var button = $(this);
            button.attr('disabled','disabled');
            var ids = $("#junior-audit").yiiGridView("getSelectedRows");
            console.log(ids);
            if(ids.length ==0) alert('请选择产品后再操作!');
            $.ajax({
            url:'{$submit}',
            type:'post',
            data:{id:ids},
            success:function(res){
                if(res=='success') alert('提交成功!');
                button.attr('disabled',false);
                location.reload();

            },
            error: function (jqXHR, textStatus, errorThrown) {
                button.attr('disabled',false);
            }
            
            });
      
    });
//取消提交

    $('#un_submit_manager').on('click',function() {
                var button = $(this);
                button.attr('disabled','disabled');
                var ids = $("#junior-audit").yiiGridView("getSelectedRows");
                console.log(ids);
                if(ids.length ==0) alert('请选择产品后再操作!');
                $.ajax({
                url:'{$unsubmit}',
                type:'post',
                data:{id:ids},
                success:function(res){
                    if(res=='success') alert('取消成功!');
                    button.attr('disabled',false);
                    // location.reload();
    
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    button.attr('disabled',false);
                }
                
                });
          
        });
JS;



$this->registerJs($is_submit_manager);
?>