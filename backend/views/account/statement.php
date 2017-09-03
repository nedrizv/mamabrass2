<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Alert;
use kartik\file\FileInput;
use backend\models\User;
use backend\models\Customer;
use yii\helpers\Url;
use kartik\date\DatePicker;
use kartik\widgets\Select2;
/* @var $this yii\web\View */
/* @var $model backend\models\mttUser */
/* @var $form yii\widgets\ActiveForm */
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="page_content">
    <div id="page_content_inner">
        <h3 class="heading_b uk-margin-bottom">Account Statement</h3> 
        <div class="md-card">
            <div class="md-card-content large-padding">
                <?php $form = ActiveForm::begin([
                            'id' => 'seller-form',
                            'fieldConfig' => ['template' => "{label}{input}{error}"],
                            'options' => ['enctype' => 'multipart/form-data'],
                        ]); ?>
                    <div class="uk-grid" data-uk-grid-margin>  
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <?php
                                echo $form->field($model, 'customer_id')->widget(Select2::classname(), [
                                    'data' => ArrayHelper::map(Customer::find()->asArray()->all(),'customer_id',function($model, $defaultValue) {
                                        return $model['customer_id'].' - '.$model['company_name'];
                                    }),
                                    'options' => ['placeholder' => 'Select Customer ...'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]);
                                ?>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <?php
                                echo $form->field($model, 'account_from_date')->widget(DatePicker::classname(), [
                                    'options' => ['placeholder' => 'From Date','onkeydown'=>'return false;'],
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'todayHighlight' => true,
                                        'format' => 'yyyy-mm-dd',
                                        'ignoreReadonly'=>false
                                    ]
                                ]);
                                ?> 
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <?php
                                echo $form->field($model, 'account_to_date')->widget(DatePicker::classname(), [
                                    'options' => ['placeholder' => 'To Date','onkeydown'=>'return false;'],
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'todayHighlight' => true,
                                        'format' => 'yyyy-mm-dd',
                                        'ignoreReadonly'=>false
                                    ]
                                ]);
                                ?> 
                            </div>
                        </div>
                        <div class="uk-width-1-1">
                            <button type="submit" class="md-btn md-btn-primary">Submit</button>
                            <?= Html::a('Cancel', ['/account/statement'], ['class' => 'md-btn md-btn-wave uk-margin-small-top']) ?>
                        </div>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
	