<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\bargain\models\RequisitionDetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="requisition-detail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tran_internal_id') ?>

    <?= $form->field($model, 'tranid') ?>

    <?= $form->field($model, 'amount') ?>

    <?= $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'item_internal_id') ?>

    <?php // echo $form->field($model, 'item_name') ?>

    <?php // echo $form->field($model, 'povendor_internalid') ?>

    <?php // echo $form->field($model, 'povendor_name') ?>

    <?php // echo $form->field($model, 'quantity') ?>

    <?php // echo $form->field($model, 'rate') ?>

    <?php // echo $form->field($model, 'createdate') ?>

    <?php // echo $form->field($model, 'lastmodifieddate') ?>

    <?php // echo $form->field($model, 'trandate') ?>

    <?php // echo $form->field($model, 'currencyname') ?>

    <?php // echo $form->field($model, 'supplier_name') ?>

    <?php // echo $form->field($model, 'contact_name') ?>

    <?php // echo $form->field($model, 'contact_tel') ?>

    <?php // echo $form->field($model, 'contact_qq') ?>

    <?php // echo $form->field($model, 'bill_type') ?>

    <?php // echo $form->field($model, 'arrival_date') ?>

    <?php // echo $form->field($model, 'payment_method') ?>

    <?php // echo $form->field($model, 'negotiant') ?>

    <?php // echo $form->field($model, 'commit_time') ?>

    <?php // echo $form->field($model, 'commit_status') ?>

    <?php // echo $form->field($model, 'audit_time') ?>

    <?php // echo $form->field($model, 'audit_status') ?>

    <?php // echo $form->field($model, 'last_price_min') ?>

    <?php // echo $form->field($model, 'after_bargain_price') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
