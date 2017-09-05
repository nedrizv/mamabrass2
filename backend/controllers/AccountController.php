<?php

namespace backend\controllers;

use Yii;
use backend\models\Customer;
use backend\models\Account;
use backend\models\AccountSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * AccountController implements the CRUD actions for Account model.
 */
class AccountController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete', 'statement'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    '@' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Account models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AccountSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionStatement()
    {   error_reporting(1); 
        $model = new Account();
        if ($model->load(Yii::$app->request->post())) {
            $customerId = $model->customer_id;
            $fromDate = $model->account_from_date;
            $toDate = $model->account_to_date;
            $customer=Customer::findOne($customerId);
            $accounts = Account::find()->where(['>=', 'account_date', $fromDate])->andWhere(['<=', 'account_date', $toDate])->andWhere(['customer_id'=>$customerId])->all();
            header("Content-type: application/vnd.ms-excel");
            header("Content-Disposition: attachment;Filename=Statement-".date("d-m-Y H:i:s").".xls");
            echo "<html>";
            echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
            echo "<body>";
            $header_str=array("Sr.No","Date","R/No.","Description","Sale","Payment","Balance","Payment-Discount");	
            $noRows=count($header_str);
            ?>
                <table width="580" border="0" cellpadding="0" style="font-size:12px;" cellspacing="0" bordercolor="#666666">
                    <tr>
                        <td align="center" colspan="<?php echo $noRows;?>"><img src="<?php echo Yii::$app->request->baseUrl;?>/img/mainlogo.png"  width="14" height="14" alt=""/></td>
                    </tr>
                    <tr>
                        <td align="left" colspan="<?php echo $noRows;?>">Customer No. <?php echo $customerId;?></td>
                    </tr>
                    <tr>
                        <td align="left" colspan="<?php echo $noRows;?>"><?php echo ucwords($customer->company_name);?></td>
                    </tr>
                    <tr>
                        <td align="left" colspan="<?php echo $noRows;?>"><?php echo ucwords($customer->address);?></td>
                    </tr>
                    <tr>
                        <td align="left" colspan="<?php echo $noRows;?>">Tel No. <?php echo $customer->tel_no;?></td>
                    </tr>
                    <tr>
                        <td align="left" colspan="<?php echo $noRows;?>">Phone No. <?php echo $customer->mob_no;?></td>
                    </tr>
                    <tr>
                        <td align="left" colspan="<?php echo $noRows;?>">Contact Person <?php echo ucwords($customer->contact_person);?></td>
                    </tr>
                    <tr>
                        <td align="left" colspan="<?php echo $noRows;?>">&nbsp;</td>
                    </tr>
                </table>
                <table width="780" border="1" cellpadding="0" style="font-size:12px;" cellspacing="0" bordercolor="#666666">
                    <tr>
                        <?php 
                        foreach($header_str AS $headerTitle)
                        {
                        ?>
                        <td align="left"><strong><?php echo $headerTitle;?></strong></td>
                        <?php
                        }
                        ?>
                    </tr>    
                    <?php
                        $cnt=1;
                        $totalAmount=0;
                        foreach($accounts AS $account)
                        {
                            $saleAmt=0;
                            $paymentAmt=0;
                            $returnAmt=0;
                            if(strtolower($account->description_type)=="pay" || strtolower($account->description_type)=="discount")
                            {
                                $paymentAmt=$account->amount;
                                $totalAmount=$totalAmount-$paymentAmt;
                            }elseif(strtolower($account->description_type)=="sale")
                            {
                                $saleAmt=$account->amount;
                                $totalAmount=$totalAmount+$saleAmt;
                            }else{
                                $saleAmt="-".$account->amount;
                                $returnAmt=$account->amount;
                                $totalAmount=$totalAmount-$returnAmt;
                            }
                            
                        ?>
                            <tr>
                                <td><?php echo $cnt;?></td>
                                <td><?php echo date("d.m.Y",strtotime($account->account_date));?></td>
                                <td><?php echo $account->account_no;?></td>
                                <td><?php echo $account->description_type;?></td>
                                <td><?php echo $saleAmt;?></td>
                                <td><?php echo $paymentAmt;?></td>
                                <td><?php echo $totalAmount;?></td>
                            </tr>
                        <?php
                            $cnt++;
                        }
                        ?>
                    <tr>
                        <td align="right" colspan="<?php echo $noRows-1;?>"><strong>Total Received Amount </strong></td>
                        <td align="left"><strong><?php echo $totalAmount;?></strong></td>
                    </tr>
                </table> 
             
            <?php
            echo "</body></html>";
            exit;
        } else {
            return $this->render('statement', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays a single Account model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Account model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Account();
        // print_r(Yii::$app->request->post()); die;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Account has been successfully Added!');
            return $this->redirect(['/account']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Account model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Account has been successfully Updated!');
            return $this->redirect(['/account']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Account model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['/account']);
    }

    /**
     * Finds the Account model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Account the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Account::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
