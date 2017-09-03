<?php
/* @var $this yii\web\View */
$this->title = 'Dashboard';
use backend\models\Customer;
?>
<div id="page_content">
    <div id="page_content_inner">            
        

        <!-- tasks -->
        <div class="uk-grid" data-uk-grid-margin data-uk-grid-match="{target:'.md-card-content'}">
            <div class="uk-width-medium-1-2">
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-overflow-container">
                            <table class="uk-table">
                                <thead>
                                    <tr>
                                        <th class="uk-text-nowrap">Customer ID</th>
                                        <th class="uk-text-nowrap">Mobile No</th>
                                        <th class="uk-text-nowrap uk-text-right">Contact Person</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $dbBookings = Customer::find()->orderBy(['customer_id' => SORT_DESC])->limit(6)->all();
                                    foreach ($dbBookings AS $dbBooking) {
                                    ?>
                                    <tr class="uk-table-middle">
                                        <td class="uk-width-3-10 uk-text-nowrap"><?php echo $dbBooking->company_name;?></td>
                                        <td class="uk-width-2-10 uk-text-nowrap"><?php echo $dbBooking->mob_no;?></td>
                                        <td class="uk-width-2-10 uk-text-right uk-text-muted uk-text-small"><?php echo $dbBooking->contact_person;?></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-width-medium-1-2">
                <div class="md-card">
                    <div class="md-card-content">
                        <h3 class="heading_a uk-margin-bottom">Statistics</h3>
                        <div id="ct-chart" class="chartist"></div>
                    </div>
                </div>
            </div>
        </div>
</div>