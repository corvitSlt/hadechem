<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Journal */

$this->title = 'Kas Masuk';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cash-in content">

    <?= $this->render('_form', [
        'model' => $model, 'dataCoa' => $dataCoa,
    ]) ?>

</div>
