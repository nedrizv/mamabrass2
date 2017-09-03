<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;
/* @var $this yii\web\View */
/* @var $model backend\models\mttUser */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Manage User';
$this->params['breadcrumbs'][] = $this->title;
?>
  <div id="page_content">
        <div id="page_content_inner">

            <h3 class="heading_b uk-margin-bottom">Change Password</h3>
			<?php if($flash = Yii::$app->session->getFlash('success')){
						echo Alert::widget(['options' => ['class' => 'uk-alert uk-alert-success'], 'body' => $flash]);
					} ?>
            <div class="md-card">
                <div class="md-card-content large-padding">
                   <?php $form = ActiveForm::begin([
								'id' => 'change-password-form',
								'fieldConfig' => [
									'template' => "{label}{input}{error}",
								],
							]); 
						?>

						<?= $form->field($model, 'current_pass')->passwordInput(['maxlength' => 200, 'placeholder' => $model->getAttributeLabel('current_pass')]) ?>

						<?= $form->field($model, 'new_pass')->passwordInput(['maxlength' => 200, 'placeholder' => $model->getAttributeLabel('new_pass')]) ?>

						<?= $form->field($model, 'retype_pass')->passwordInput(['maxlength' => 200, 'placeholder' => $model->getAttributeLabel('retype_pass')]) ?>
						       
                        <div class="uk-grid">
                            <div class="uk-width-1-1">
                                <?= Html::submitButton($model->isNewRecord ? Yii::t('yii', 'Create') : Yii::t('yii', 'Save Changes'), ['class' => $model->isNewRecord ? 'md-btn md-btn-success' : 'md-btn md-btn-primary']) ?>
                            </div>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>

        </div>
    </div>