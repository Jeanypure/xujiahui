<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
/* @var $this yii\web\View */
/* @var $model backend\models\PurInfo */

$this->title = Yii::t('app', '自主开发产品');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pur Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="pur-info-create">
    <div class="pur-info-form">
        <?php
        $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]);

        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>4,
            'contentBefore'=>'<legend class="text-info"><h3>1.基本信息</h3></legend>',
            'attributes'=>[       // 3 column layout
                'pur_group'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'pd_title'=>['type'=>Form::INPUT_TEXT,
                    'labelOptions'=>['class'=>'label-require'],
                    'options'=>['placeholder'=>'','class'=>'label-require']],
                'pd_title_en'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'pd_pic_url'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'地址格式:https://XXXX.jpg|png|gif等']],
            ],

        ]);
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>4,
            'attributes'=>[       // 3 column layout
                'ebay_url'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'amazon_url'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'url_1688'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'else_url'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            ],
            'contentAfter' => '<div ><br> <br></div>'

        ]);

        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>4,
            'contentBefore'=>'<legend class="text-info"><h3>2.尺寸重量</h3></legend>',
            'attributes'=>[       // 2 column layout
                'pd_length'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'pd_width'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'pd_height'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'pd_weight'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'pd_throw_weight'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'pd_count_weight'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],

            ]
        ]);

        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>6,
            'attributes'=>[       // 2 column layout
                'pd_package'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'pd_material'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'',]],
                'is_huge'=>[
                    'type'=>Form::INPUT_RADIO_LIST,
                    'items'=>[1=>'是', 0=>'否'],
                    'options'=>['placeholder'=>'',
                    ]
                ],
            ],
            'contentAfter' => '<div ><br> <br></div>'

        ]);

        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>6,
            'contentBefore'=>'<legend class="text-info"><h3>3.税费信息</h3></legend>',
            'attributes'=>[       // 2 column layout
                'pd_pur_costprice'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'bill_tax_rebate'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'bill_rebate_amount'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'shipping_fee'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'oversea_shipping_fee'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'transaction_fee'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],

            ]
        ]);
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>6,
            'attributes'=>[       // 6 column layout

                'retail_price'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'no_rebate_amount'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'gross_profit'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'profit_rate'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],


            ]
        ]);


        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>6,
            'attributes'=>[       // 6 column layout
                'amz_retail_price'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'amz_retail_price_rmb'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'gross_profit_amz'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'profit_rate_amz'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            ]
        ]);

        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>6,
            'attributes'=>[       // 6 column layout
                'selling_on_amz_fee'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'amz_fulfillment_cost'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
                'ams_logistics_fee'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            ]
        ]);
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>6,
            'attributes'=>[       // 6 column layout
                'pd_purchase_num'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],

                'hs_code'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],

                'bill_type'=>['type'=>Form::INPUT_RADIO_LIST,
                    'items'=>['16%专票'=>'16%专票','增值税普通普票'=>'增值税普通普票', '3%专票'=>'3%专票'],
                    'label'=>"<span style = 'color:red'><big>*</big></span>开票类型",
                    'options'=>['placeholder'=>'']],
                'has_shipping_fee'=>[
                    'type'=>Form::INPUT_RADIO_LIST,
                    'label'=>"<span style = 'color:red'><big>*</big></span>是否含运费",
                    'items'=>[1=>'是', 0=>'否'],
                    'options'=>['placeholder'=>'']],
                'trading_company'=>[
                    'type'=>Form::INPUT_RADIO_LIST,
                    'label'=>"<span style = 'color:red'><big>*</big></span>供应商是否是贸易公司",
                    'items'=>[1=>'是', 0=>'否'],
                    'options'=>['placeholder'=>'']],


            ]
        ]);


        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>1,
            'contentBefore'=>'<legend class="text-info"><h3>4.附加信息</h3></legend>',
            'attributes'=>[       // 1 column layout
                'remark'=>['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'','style'=>'height:150px']]
            ]
        ]);


        ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>

        </div>

        <?php ActiveForm::end(); ?>

    </div>




</div>
    <?php

    //css 表单input 变圆润

        $this->registerJs("
        $(function () {
            $('.form-control').css('border-radius','7px')
        }); 
        ", \yii\web\View::POS_END);
    $readonly_js =<<<JS
        $(function(){
            $("#purinfo-pd_throw_weight").attr("readonly","readonly");
            $("#purinfo-pd_count_weight").attr("readonly","readonly");
            $("#purinfo-is_huge").attr("readonly","readonly");
            $("#purinfo-bill_rebate_amount").attr("readonly","readonly");
            $("#purinfo-shipping_fee").attr("readonly","readonly");
            $("#purinfo-oversea_shipping_fee").attr("readonly","readonly");
            $("#purinfo-transaction_fee").attr("readonly","readonly");
            $("#purinfo-gross_profit").attr("readonly","readonly");
            $("#purinfo-profit_rate").attr("readonly","readonly");
              
            $("#purinfo-gross_profit_amz").attr("readonly","readonly");
            $("#purinfo-profit_rate_amz").attr("readonly","readonly");
            $("#purinfo-ams_logistics_fee").attr("readonly","readonly");
            
            $("#purinfo-amz_retail_price_rmb").attr("readonly","readonly");

            
            $("#purinfo-no_rebate_amount").attr("readonly","readonly");
            $("#purinfo-pur_group").attr("readonly","readonly");
            
            $("label[for='purinfo-pd_title'] ").addClass("label-require");
            $("label[for='purinfo-pd_title_en'] ").addClass("label-require");
            $("label[for='purinfo-pd_pic_url'] ").addClass("label-require");
            $("label[for='purinfo-pd_length'] ").addClass("label-require");
            $("label[for='purinfo-pd_width'] ").addClass("label-require");
            $("label[for='purinfo-pd_height'] ").addClass("label-require");
            $("label[for='purinfo-pd_weight'] ").addClass("label-require");
            $("label[for='purinfo-pd_package'] ").addClass("label-require");
            $("label[for='purinfo-pd_material'] ").addClass("label-require");
            $("label[for='purinfo-pd_pur_costprice'] ").addClass("label-require");
            $("label[for='purinfo-bill_tax_rebate'] ").addClass("label-require");
            $("label[for='purinfo-retail_price'] ").addClass("label-require");
            $("label[for='purinfo-pd_purchase_num'] ").addClass("label-require");
            $("label[for='purinfo-bill_type'] ").addClass("label-require");
            $("label[for='purinfo-amz_retail_price'] ").addClass("label-require");
            $("label[for='purinfo-hs_code'] ").addClass("label-require");


            
            $('.label-require').html(function(_,html) {
                return html.replace(/(.*?)/, "<span style = 'color:red'><big>*$1</big></span>");
            });


        });
        
JS;
        $this->registerJs($readonly_js);
    ?>

<?php
//计算是否是大件

$compute_js =<<<JS
        $('#w0').on('change',function() {
            var height = $("#purinfo-pd_height").val();
            var width = $("#purinfo-pd_width").val();
            var length = $("#purinfo-pd_length").val();
            
            var height_in = $("#purinfo-pd_height").val()*0.39.toFixed(3);
            var width_in = $("#purinfo-pd_width").val()*0.39.toFixed(3);
            var length_in = $("#purinfo-pd_length").val()*0.39.toFixed(3);
           
            if(parseFloat(height_in)>=8){
                $(":radio[name ='PurInfo[is_huge]'][value='1']").prop("checked","checked");
            }else if(parseFloat(width_in)>=14){
                $(":radio[name ='PurInfo[is_huge]'][value='1']").prop("checked","checked");
            }else if(parseFloat(length_in)>=18 ){
                $(":radio[name ='PurInfo[is_huge]'][value='1']").prop("checked","checked");
            }else{
                $(":radio[name ='PurInfo[is_huge]'][value='0']").prop("checked","checked");
            }
                          
            var amz_pound_weight = (height_in*width_in*length_in/139).toFixed(3); // amz计算重量 单位 磅
            var thow_weight = (height_in*width_in*length_in*0.45/139).toFixed(3); //抛重 kg
           
            $('#purinfo-pd_throw_weight').val(thow_weight) ;
            var fact_weight = $('#purinfo-pd_weight').val();
            var count_weight;
       
            if(parseFloat(fact_weight) > parseFloat(thow_weight)){
                count_weight = fact_weight;
            }else{
                count_weight = thow_weight;
            }
            
            $("#purinfo-pd_count_weight").val(count_weight);
            //tax
            var costprice = $("#purinfo-pd_pur_costprice").val(); //含税价格
            var tax_rebate = $("#purinfo-bill_tax_rebate").val(); //退税率
            var bill_rebate_amount = (tax_rebate * costprice/100).toFixed(3);       //退税金额
            // $("#purinfo-bill_rebate_amount").val(amount_rebate);
            $("#purinfo-bill_rebate_amount").val(bill_rebate_amount);
            
            
            //海运运费估计
            var  shipping_fee;
            var is_huge = $("input[name='PurInfo[is_huge]']:checked").val();
           
            var shipping_fee;
            if(is_huge==0){
                shipping_fee = (count_weight*5).toFixed(3);
            }else{
                shipping_fee = ((length*width*height/1000000)*800).toFixed(3);
            }
            $("#purinfo-shipping_fee").val(shipping_fee);
            
            //海外仓运费预估 purinfo-oversea_shipping_fee 
            //是大件在判断
             //小号 中号 大号 特殊大件
             //small_huge 小号  70磅  长60in 宽30in 长度+周长130in 
             //middle_huge 中号  150磅  长108in  长度+周长 130in 
             //big_huge 大号  150磅  长108in  长度+周长 165in 
             //else_huge 特殊大件  >150磅  长60in 宽30in  >长度+周长165in 
             var oversea_fee;
            
            if(is_huge==1){
                var perimeter = (width_in+height_in)*2 ; //周长
                var len_cir = length_in+perimeter;
                if(amz_pound_weight<70 && length_in < 60 && width_in< 30 && len_cir< 130){ //small_huge = 1;
                    oversea_fee = ((8.13 + (amz_pound_weight-2)*0.38)*$exchange_rate).toFixed(3);
                }else if(amz_pound_weight<150 && length_in < 108  && len_cir< 130){ // middle_huge = 1;
                    oversea_fee = ((9.44 + (amz_pound_weight-2)*0.38)*$exchange_rate).toFixed(3);
                }else if(amz_pound_weight<150 && length_in < 108  && len_cir< 165){ // big_huge=1;
                     oversea_fee = ((73.18 + (amz_pound_weight-90)*0.79)*$exchange_rate).toFixed(3);
                }else if(amz_pound_weight>150 || length_in > 108  || len_cir> 165){ //else_huge = 1;
                     oversea_fee = ((137.32 +(amz_pound_weight-90)*0.91)*$exchange_rate).toFixed(3);
                }
                
            }else if(is_huge==0){
                if(count_weight<=1){
                oversea_fee = (6.5*$exchange_rate).toFixed(3); //$exchange_rate 是美元汇率
                }else{
                    // oversea_fee = (count_weight-1)*1.2*$exchange_rate+6.5*$exchange_rate;
                    oversea_fee = (((count_weight-1)*1.2+6.5)*$exchange_rate).toFixed(3) ;
                }
            }
            
            $("#purinfo-oversea_shipping_fee").val(oversea_fee);
            
            
            //成交费 purinfo-transaction_fee
            var transaction_fee;
            var retail_price = $("#purinfo-retail_price").val(); //预计销售价格 $
            transaction_fee = (retail_price*$exchange_rate*0.13).toFixed(3);
            $("#purinfo-transaction_fee").val(transaction_fee);
            
            //预计销售额 RMB  purinfo-no_rebate_amount
            var no_rebate_amount = (retail_price*$exchange_rate).toFixed(3)
            
            $("#purinfo-no_rebate_amount").val(no_rebate_amount);
            
            //预估毛利 purinfo-gross_profit
            //预估毛利= 预计销售价格RMB-含税价格+退税金额-海运运费-海外仓运费-成交费
            var gross_profit;
            //含税价格 costprice
            gross_profit = (no_rebate_amount-costprice+(bill_rebate_amount)-(shipping_fee)-(oversea_fee)-transaction_fee).toFixed(3) ;
            $("#purinfo-gross_profit").val(gross_profit);
              //毛利率--eBay
            var profit_rate = (gross_profit*100/no_rebate_amount).toFixed(3);
             $("#purinfo-profit_rate").val(profit_rate);
             
                //amz 最低售价 $ rmb
            var amz_retail_price = $("#purinfo-amz_retail_price").val();
            var amz_retail_price_rmb = (amz_retail_price*$exchange_rate).toFixed(3);
            $("#purinfo-amz_retail_price_rmb").val(amz_retail_price_rmb);
             
             //amz   amz_fulfillment_cost
             var fulfillment_cost = $("#purinfo-amz_fulfillment_cost").val();
             
             
             // amz selling_on_amz_fee
             var amz_selling_on_amz_fee = $("#purinfo-selling_on_amz_fee").val();
             
             //amz 物流计算费用 $ = 成交费+派送费
             // var ams_logistics_fee = $("#purinfo-ams_logistics_fee").val();
             var ams_logistics_fee = (parseFloat(fulfillment_cost) + parseFloat(amz_selling_on_amz_fee)).toFixed(3);
             $("#purinfo-ams_logistics_fee").val(ams_logistics_fee);
            
             //amz 毛利¥
             //amz 毛利率%
             
            var gross_profit_amz;
            gross_profit_amz = (amz_retail_price_rmb-costprice+(bill_rebate_amount)-(ams_logistics_fee*$exchange_rate)-shipping_fee).toFixed(3) ;
            $("#purinfo-gross_profit_amz").val(gross_profit_amz);

             //amz毛利率
            var profit_rate_amz = (gross_profit_amz*100/amz_retail_price_rmb).toFixed(3);
             $("#purinfo-profit_rate_amz").val(profit_rate_amz);
             
          
            
        });

JS;

$this->registerJs($compute_js);

?>
