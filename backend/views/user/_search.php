<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

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
                <?= $form->field($model, 'name')->textInput(['class'=>'md-input']) ?>
            </div>
            <div class="uk-width-medium-3-10">
                <?= $form->field($model, 'email')->textInput(['class'=>'md-input']) ?>
            </div>
            <div class="uk-width-medium-3-10">
                <?= $form->field($model, 'contact_no')->textInput(['class'=>'md-input']) ?>
            </div>
            <div class="uk-width-medium-4-10">
                <?= Html::submitButton('Search', ['class' => 'md-btn md-btn-primary uk-margin-small-top']) ?>
                &nbsp;
                <?= Html::a('Reset', ['/user'], ['class' => 'md-btn md-btn-wave uk-margin-small-top']) ?>
            
            </div>
            
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>

