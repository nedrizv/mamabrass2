<?php
/**
 * @link http://phe.me
 * @copyright Copyright (c) 2014 Pheme
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace yii\grid;

use yii\grid\DataColumn;
use yii\helpers\Html;
use yii\web\View;
use Yii;
?>
<style>
.glyphicon-remove-circle {
  color : #C9302C;
}
.glyphicon-ok-circle {
  color : #449D44;
}
</style>
<?php
/**
 * @author Aris Karageorgos <aris@phe.me>
 */
class ToggleColumn extends DataColumn
{
    /**
     * Toggle action that will be used as the toggle action in your controller
     * @var string
     */
    public $action = 'toggle';

    /**
     * Whether to use ajax or not
     * @var bool
     */
    public $enableAjax = true;

    public function init()
    {
        if ($this->enableAjax) {
            $this->registerJs();
        }
    }

    /**
     * @inheritdoc
     */
    protected function renderDataCellContent($model, $key, $index)
    {
	/* @Edited By AmitG  */

	if(get_class($model) == 'admin\models\Country')
		$url = [$this->action, 'country_code' => $model->country_code];

        $attribute = $this->attribute;
        $value = $model->$attribute;
	
        if ($value === null || $value == 0 ) {		// 4-5-2015   $value=true replace with $value=0
            $icon = 'close';
            $title = Yii::t('yii', 'InActive');
        } else {
            $icon = 'check';
            $title = Yii::t('yii', 'Active');
        }
        return Html::a(
            '<span class="ti ti-' . $icon . '" style="font-size:18px; text-algin:center;"></span>',
            $url,
            [
                'title' => $title,
                'class' => 'toggle-column',
                'data-method' => 'post',
                'data-pjax' => '0',
            ]
        );
    }

    /**
     * Registers the ajax JS
     */
    public function registerJs()
    {
        $js = <<< JS
$("a.toggle-column").on("click", function(e) {
    e.preventDefault();
    $.post($(this).attr("href"), function(data) {
        var pjaxId = $(e.target).closest(".grid-view").parent().attr("country_code");
        $.pjax.reload({container:"#" + pjaxId});
    });
    return false;
});
JS;
        $this->grid->view->registerJs($js, View::POS_READY, 'pheme-toggle-column');
    }
}
