<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>Mama Brass - Customer Management System</title>
    <?php $this->head() ?>
    <!-- altair admin -->
    <?php if(Yii::$app->user->isGuest){?>
    <link rel="stylesheet" href="<?php echo Yii::$app->request->baseUrl;?>/css/login_page.min.css" media="all">
    <?php }else{ ?>
    <link rel="stylesheet" href="<?php echo Yii::$app->request->baseUrl;?>/css/main.min.css" media="all">
	 <link rel="stylesheet" href="<?php echo Yii::$app->request->baseUrl;?>/bower_components/kendo-ui/styles/kendo.common-material.min.css"/>
    <link rel="stylesheet" href="<?php echo Yii::$app->request->baseUrl;?>/bower_components/kendo-ui/styles/kendo.material.min.css"/> 
    <link rel="stylesheet" href="<?php echo Yii::$app->request->baseUrl;?>/bower_components/chartist/dist/chartist.min.css">
    <?php
    }
    ?>
    <!-- matchMedia polyfill for testing media queries in JS -->
    <!--[if lte IE 9]>
        <script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl.'/bower_components/matchMedia/matchMedia.js';?>"></script>
        <script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl.'/bower_components/matchMedia/matchMedia.addListener.js'?>"></script>
    <![endif]-->
	<?php  echo Html::csrfMetaTags(); ?>
</head>
<body class="login_page">
<?php $this->beginBody() ?>
<!-- main header -->
<?php
if(!Yii::$app->user->isGuest){
    echo \backend\components\Headerwidget::widget();
    echo \backend\components\Sitebarwidget::widget();
}
echo $content;?>

<script src="<?php echo Yii::$app->request->baseUrl;?>/js/common.min.js"></script>
<script src="<?php echo Yii::$app->request->baseUrl;?>/js/uikit_custom.js"></script>
<script src="<?php echo Yii::$app->request->baseUrl;?>/js/altair_admin_common.js"></script>

<?php $this->endBody() ?>
   

<!-- google web fonts -->
<script>
    WebFontConfig = {
        google: {
            families: [
                'Source+Code+Pro:400,700:latin',
                'Roboto:400,300,500,700,400italic:latin'
            ]
        }
    };
    (function() {
        var wf = document.createElement('script');
        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
        '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
        wf.type = 'text/javascript';
        wf.async = 'true';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(wf, s);
    })();
</script>
<script src="<?php echo Yii::$app->request->baseUrl;?>/bower_components/ckeditor/ckeditor.js"></script>
<script src="<?php echo Yii::$app->request->baseUrl;?>/bower_components/ckeditor/adapters/jquery.js"></script>
<script src="<?php echo Yii::$app->request->baseUrl;?>/js/pages/forms_wysiwyg.min.js"></script>
<script src="<?php echo Yii::$app->request->baseUrl;?>/js/kendoui_custom.min.js"></script>
<script src="<?php echo Yii::$app->request->baseUrl;?>/js/pages/kendoui.min.js"></script>

<script>
    $(function() {
        // enable hires images
        altair_helpers.retina_images();
        // fastClick (touch devices)
        if(Modernizr.touch) {
            FastClick.attach(document.body);
        }
    });
</script>

<!-- page specific plugins -->
        <!-- metrics graphics (charts) -->
        <script src="<?php echo Yii::$app->request->baseUrl;?>/bower_components/metrics-graphics/dist/metricsgraphics.min.js"></script>
        <!-- chartist (charts) -->
        <script src="<?php echo Yii::$app->request->baseUrl;?>/bower_components/chartist/dist/chartist.min.js"></script>
        <!-- peity (small charts) -->
        <script src="<?php echo Yii::$app->request->baseUrl;?>/bower_components/peity/jquery.peity.min.js"></script>
        <!-- easy-pie-chart (circular statistics) -->
        <script src="<?php echo Yii::$app->request->baseUrl;?>/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
        
        <!--  dashbord functions -->
        <script src="<?php echo Yii::$app->request->baseUrl;?>/js/pages/dashboard.js"></script>


<script type="text/javascript">
function showHidePreLoader(act="")
{
    if(act=="s")
    {
        altair_helpers.content_preloader_show('regular');  
    }else{
        altair_helpers.content_preloader_hide();
    }    
}
</script>
</body>
</html>
<?php $this->endPage() ?>
