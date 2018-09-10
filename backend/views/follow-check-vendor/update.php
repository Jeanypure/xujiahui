<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\YaeSupplier */

$this->title = '查询供应商信息: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Yae Suppliers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="yae-supplier-update">


    <?= $this->render('_form', [
        'model' => $model,
        'supplier_contact' => $supplier_contact,
    ]) ?>



</div>
