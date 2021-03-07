<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Journal */

$this->title = 'Kas Keluar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cash-out content">

    <?= $this->render('_form', [
        'model' => $model, 'dataCoa' => $dataCoa,
    ]) ?>

</div>
