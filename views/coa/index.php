<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Master Akun';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coa-index content">
	<?= $this->render('_form', [
        'model' => $model, 'dataAccountGroup' => $dataAccountGroup, 
    ]) ?>
</div>
