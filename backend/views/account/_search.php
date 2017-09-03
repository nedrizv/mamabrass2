<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\User;
use backend\models\Customer;

use kartik\date\DatePicker;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\SchoolSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
<div class="md-card">
    <div class="md-card-content">
        <div class="uk-grid" data-uk-grid-margin="">
            <div class="uk-width-medium-3-10">
                <?= $form->field($model, 'account_no')->textInput(['class'=>'md-input']) ?>
            </div>
            <div class="uk-width-medium-3-10">
                <?php
                echo $form->field($model, 'customer_id')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Customer::find()->asArray()->all(),'customer_id','company_name'),
                    'options' => ['placeholder' => 'Select Customer ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
            </div>
            <div class="uk-width-medium-4-10">
                <?= Html::submitButton('Search', ['class' => 'md-btn md-btn-primary uk-margin-small-top']) ?>
                &nbsp;
                <?= Html::a('Reset', ['/account'], ['class' => 'md-btn md-btn-wave uk-margin-small-top']) ?>
            
            </div>
            
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>


