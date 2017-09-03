<?php
namespace backend\components;

use yii\base\Widget;
use yii\helpers\Html;

class Headerwidget extends Widget{
    public function init(){
            // add your logic here
    }
    public function run(){
            return $this->render('headerWidget');
    }
}
?>