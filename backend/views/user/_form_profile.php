<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Alert;
use kartik\file\FileInput;
use yii\helpers\Url;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model backend\models\mttUser */
/* @var $form yii\widgets\ActiveForm */
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="page_content">
    <div id="page_content_inner">

        <h3 class="heading_b uk-margin-bottom">Create/Edit Profile</h3>
        
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
                                
                                <?= $form->field($model, 'username')->textInput(['class'=>'md-input','required'=>true]) ?>
                            </div>
                        </div>
                        
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <?= $form->field($model, 'password')->passwordInput(['class'=>'md-input','required'=>true]) ?>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <?php $userTitles=['Mr.'=>'Mr.','Mrs.'=>'Mrs.','Ms.'=>'Ms.','Dr.'=>'Dr.','Prof.'=>'Prof.'];?>
                                <?= $form->field($model, 'title')->dropDownList($userTitles,['required'=>true,'prompt'=>'-User Title-']) ?>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <?= $form->field($model, 'name')->textInput(['class'=>'md-input','required'=>true, 'onchange'=>'checkAvailability()']) ?>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="parsley-row">
                                <?= $form->field($model, 'address')->textArea(['class'=>'md-input','required'=>true]) ?>
                            </div>
                        </div>
                        
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <?= $form->field($model, 'contact_no')->textInput(['class'=>'md-input','required'=>true, 'onchange'=>'checkAvailability()']) ?>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <?= $form->field($model, 'email')->textInput(['class'=>'md-input']) ?>
                            </div>
                        </div>
                        
                            <div class="uk-width-medium-1-3">
                                <div class="parsley-row">
                                <?php if ($model->profile_image){ 
                                    echo Html::img($model->getAdmPhoto($model->profile_image), ["width"=>"200px", "height"=>"200px", 'style'=>'display: table; margin: 8px; height: 160px;    border: 1px solid #ddd;    box-shadow: 1px 1px 5px 0px #a2958a;    padding: 6px;     text-align: center;    vertical-align: middle;', 'id'=>'profile_image']); 
                                }else{
                                    '';
                                }
                                    
                                    ?>	
                        
                                    <?php echo $form->field($model, 'profile_image')->widget(FileInput::classname(), [
                                                
                                            'options' => ['accept' => 'image/*'],
                                            'pluginOptions' => [
                                                'showPreview' => true,
                                                'showCaption' => true,
                                                'showRemove' => false,
                                                'showUpload' => false
                                            ],
                                        ]);

                                        // With model & without ActiveForm
                                            ?>
                                    </div>	 
                                </div>
                    
                        <div class="uk-width-1-1">
                            <button type="submit" class="md-btn md-btn-primary">Submit</button>
                            &nbsp;
                            <?= Html::a('Cancel', ['/user'], ['class' => 'md-btn md-btn-wave uk-margin-small-top']) ?>
                        </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
</div>

<script>
function checkAvailability()
{
    $("#submit_btn").prop("disabled",false);
    var name=$("#user-name").val();
    var contactNo = $("#user-contact_no").val();
    if(name!="" && contactNo!="")
    {
        jQuery.ajax({
            url: "<?php echo Url::to(['user/checkuser']);?>",
            data:'name='+name+'&contact_no='+contactNo,
            type: "GET",
            success:function(data)
            {
                if(data=="1")
                {
                    UIkit.modal.alert("Enter Name and Contact No. are available in database!");
                    $("#submit_btn").prop("disabled",true);
                }else{
                    $("#submit_btn").prop("disabled",false);
                }   
            },
            error:function (){}
        });
    }
}
</script>
	