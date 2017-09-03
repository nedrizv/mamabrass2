<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Alert;
use kartik\file\FileInput;
use backend\models\User;
use yii\helpers\Url;
use kartik\datetime\DateTimePicker;
use kartik\widgets\Select2;
/* @var $this yii\web\View */
/* @var $model backend\models\mttUser */
/* @var $form yii\widgets\ActiveForm */
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="page_content">
    <div id="page_content_inner">
        <h3 class="heading_b uk-margin-bottom">Add Customer</h3> 
        <div class="md-card">
            <div class="md-card-content large-padding">
                <?php $form = ActiveForm::begin([
                            'id' => 'seller-form',
                            'fieldConfig' => ['template' => "{label}{input}{error}"],
                            'options' => ['enctype' => 'multipart/form-data'],
                        ]); ?>
                    <div class="uk-grid" data-uk-grid-margin>  
                        <div class="uk-width-medium-1-1">
                            <div class="parsley-row">
                                <?= $form->field($model, 'company_name')->textInput(['class'=>'md-input','required'=>true]) ?>  
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="parsley-row">
                                <?= $form->field($model, 'address')->textArea(['class'=>'md-input']) ?> 
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <?= $form->field($model, 'tel_no')->textInput(['class'=>'md-input']) ?> 
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <?= $form->field($model, 'mob_no')->textInput(['class'=>'md-input','required'=>true]) ?> 
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <?= $form->field($model, 'contact_person')->textInput(['class'=>'md-input','required'=>true]) ?> 
                            </div>
                        </div>
                        <div class="uk-width-1-1">
                            <button type="submit" class="md-btn md-btn-primary">Submit</button>
                            <?= Html::a('Cancel', ['/customer'], ['class' => 'md-btn md-btn-wave uk-margin-small-top']) ?>
                        </div>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
	