<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>

   
   <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
		'options' => ['class' => 'log-in', 'autocomplete' => 'off'],
        'fieldConfig' => [
            'template' => "{input}\n{label}\n",
        ],
    ]); ?>
		<h4>We are <span><?= Html::img('@web/img/logo1-black.png')?></span></h4>
        <p>Welcome back! Log in to your account:</p>
        <?= $form->field($model, 'username',['template' => "{input}\n{label}\n<div class=\"icon\">\n<i class=\"ion ion-ios-person-outline\"></i>\n</div>\n<div class=\"help-msg-block\">\n{error}\n</div>"])->textInput(['placeholder' => 'Username', 'autofocus' => true,'autocomplete' => 'off']) ?>

        <?= $form->field($model, 'password',['template' => "{input}\n{label}\n<div class=\"icon\">\n<i class=\"ion ion-ios-locked-outline\"></i>\n</div>\n<div class=\"icon show-pswrd\">\n<i id=\"toggle-pswrd\" class=\"far fa-eye-slash\"></i>\n</div>\n<div class=\"help-msg-block\">\n{error}\n</div>"])->passwordInput(['class' => 'form-control pswrd','placeholder' => 'Password','autocomplete' => 'off']) ?>

        <?= Html::submitButton('Login', ['class' => 'btn-login btn btn-primary', 'name' => 'login-button']) ?>
            

    <?php ActiveForm::end(); ?>