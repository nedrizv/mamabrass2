<?php
use yii\helpers\Html;
use yii\helpers\Url;
$eInfo = backend\models\User::find()->where(['user_id'=>Yii::$app->user->id])->one();
?>
<!-- main sidebar -->
<aside id="sidebar_main">
    
    <div class="sidebar_main_header">
        <div class="sidebar_logo">
            <a href="<?= Url::to(['/site'])?>" class="sSidebar_hide"><img src="<?php echo Yii::$app->request->baseUrl;?>/img/mainlogo.png" alt=""/></a>
            <a href="<?= Url::to(['/site'])?>" class="sSidebar_show"><img src="<?php echo Yii::$app->request->baseUrl;?>/img/logo_main_small.png" alt="" height="32" width="32"/></a>
        </div>
    </div>
    
    <div class="menu_section">
        <ul>
            <li <?php if(strtolower(Yii::$app->controller->id)=='site') { echo 'class="current_section"';}?> title="Dashboard">
                <a href="<?= Url::to(['/site'])?>">
                    <span class="menu_icon"><i class="material-icons">&#xE871;</i></span>
                    <span class="menu_title">Dashboard</span>
                </a>
            </li>
            <li title="Users" <?php if(strtolower(Yii::$app->controller->id)=='user') { echo 'class="current_section"';}?>>
                <?= Html::a('<span class="menu_icon"></span><span class="menu_title">Users</span>', ['/user']) ?>
            </li>
			
            <li title="Customer" <?php if(strtolower(Yii::$app->controller->id)=='customer') { echo 'class="current_section"';}?>>
                <?= Html::a('<span class="menu_icon"></span><span class="menu_title">Manage Customers</span>', ['/customer']) ?>
            </li>

            <li title="Account" <?php if(strtolower(Yii::$app->controller->id)=='account' && strtolower(Yii::$app->controller->action->id)!='statement') { echo 'class="current_section"';}?>>
                <?= Html::a('<span class="menu_icon"></span><span class="menu_title">Manage Accounts</span>', ['/account']) ?>
            </li>

            <li title="Account Statement" <?php if(strtolower(Yii::$app->controller->action->id)=='statement') { echo 'class="current_section"';}?>>
                <?= Html::a('<span class="menu_icon"></span><span class="menu_title">Account Statement</span>', ['/account/statement']) ?>
            </li>
                
        </ul>
        
    </div>
    
</aside><!-- main sidebar end -->
<script>
function menuShowHide(mID)
{
	$('#'+mID).toggle();
}
</script>