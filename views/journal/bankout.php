<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Journal */

$this->title = 'Bank Keluar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bank-out content">

    <?= $this->render('_form', [
        'model' => $model, 'dataCoa' => $dataCoa,
    ]) ?>

</div>
