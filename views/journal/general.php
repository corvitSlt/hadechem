<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Journal */

$this->title = 'Journal Umum';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="general-journal content">

    <?= $this->render('_form', [
        'model' => $model, 'dataCoa' => $dataCoa,
    ]) ?>

</div>
