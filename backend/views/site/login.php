<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login_page_wrapper">
    <div class="md-card" id="login_card">
        <div class="md-card-content large-padding" id="login_form">
            <div class="login_heading">
                <div class="user_avatar"></div>
            </div>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <div class="uk-form-row">
                    <?= $form->field($model, 'username')->textInput(['autofocus' => true,'class'=>'md-input']) ?>
                </div>
                <div class="uk-form-row">
                    <?= $form->field($model, 'password')->passwordInput(['class'=>'md-input']) ?>
                </div>
                <div class="uk-margin-medium-top">
                    <?= Html::submitButton('Sign In', ['class' => 'md-btn md-btn-primary md-btn-block md-btn-large', 'name' => 'login-button']) ?>
                </div>
                <div class="uk-margin-top">
                    <a href="#" id="login_help_show" class="uk-float-right">Need help?</a>
                    <span class="icheck-inline">
                        <?= $form->field($model, 'rememberMe')->checkbox(['data-md-icheck'=>'']) ?>
                     </span>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>