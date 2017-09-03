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
            <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
                <div class="uk-width-large-11-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar">
                                <div class="thumbnail" style="width:100px; height:80px;">
									<?php $EmpInfo = backend\models\User::findOne(['user_id'=>Yii::$app->user->id]);  ?>
										<?= Html::img($EmpInfo->getAdmPhoto($EmpInfo->profile_image),[ 'style'=>'height:67px;', 'alt'=>'My Profile']); ?>
								</div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b uk-margin-bottom"><span class="uk-text-truncate"><?php echo ucfirst(Yii::$app->user->identity->name); ?></span></h2>
							</div>
                        </div>
                        <div class="user_content">
                            <ul id="user_profile_tabs" class="uk-tab" data-uk-tab="{connect:'#user_profile_tabs_content', animation:'slide-horizontal'}" data-uk-sticky="{ top: 48, media: 960 }">
                                
                            </ul>
							<?php if($flash = Yii::$app->session->getFlash('success')){
								echo Alert::widget(['options' => ['class' => 'uk-alert uk-alert-success'], 'body' => $flash]);
								} ?>
							<h3 class="full_width_in_card heading_c">Contact info</h3>
                            <ul id="user_profile_tabs_content" class="uk-switcher uk-margin">
                                <li>
                                    <div class="uk-grid">
										<div class="uk-width-1-1">
											<div class="uk-grid uk-grid-width-1-1 uk-grid-width-large-1-2" data-uk-grid-margin>
												<div>
													<div class="uk-input-group">
														<span class="uk-input-group-addon">
															<i class="material-icons">&#xE851;</i>
														</span>
														<label>User Name</label><br>
														&nbsp; 
														<?php echo ucfirst(Yii::$app->user->identity->username); ?>
													</div>
												</div>
												<div>
													<div class="uk-input-group">
														<span class="uk-input-group-addon">
															<i class="md-list-addon-icon material-icons">&#xE0CD;</i>
														</span>
														<label>Phone Number</label><br>
														<?php echo ucfirst(Yii::$app->user->identity->contact_no); ?>
													</div>
												</div>
												<div>
													<div class="uk-input-group">
														<span class="uk-input-group-addon">
															<i class="material-icons">&#xE85E;</i>
														</span>
														<label>Name</label><br>
														<?php echo ucfirst(Yii::$app->user->identity->name); ?>
													</div>
												</div>
												<div>
													<div class="uk-input-group">
														<span class="uk-input-group-addon">
															<i class="material-icons">&#xE158;</i>
														</span>
														<label>Email</label><br>
														<?php echo Yii::$app->user->identity->email; ?>
													</div>
												</div>
											    	<div>
													<div class="uk-input-group">
													</div>
												</div>
											</div>
										</div>
                                </li>
                             </ul>
                        </div>
                    </div>
                </div>
             </div>
        </div>
    </div>