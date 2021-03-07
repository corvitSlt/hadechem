<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jurnal';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="journal-index content">
    <?= $this->render('_formIndex', []) ?>
</div>
