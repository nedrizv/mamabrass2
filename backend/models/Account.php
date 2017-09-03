<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%account}}".
 *
 * @property integer $account_id
 * @property integer $customer_id
 * @property string $account_no
 * @property string $description_type
 * @property double $amount
 * @property string $account_date
 * @property string $created_on
 * @property integer $user_id
 */
class Account extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $account_from_date;
    public $account_to_date;

    public static function tableName()
    {
        return '{{%account}}';
    }

    public function beforeSave($insert)
	{
	     if (parent::beforeSave($insert)) {
		    if($insert)
			   $this->created_on = date('Y-m-d H:i:s');
			   $this->user_id = Yii::$app->user->id;
		    return true;
	     } else {
		   return false;
	     }
	}

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'account_no', 'description_type', 'amount', 'account_date'], 'required'],
            [['customer_id', 'user_id'], 'integer'],
            [['description_type'], 'string'],
            [['amount'], 'number'],
            [['account_date', 'created_on', 'user_id', 'account_from_date', 'account_to_date'], 'safe'],
            [['account_no'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'account_id' => 'Ref ID',
            'customer_id' => 'Customer',
            'account_no' => 'Ref No',
            'description_type' => 'Description Type',
            'amount' => 'Amount',
            'account_date' => 'Account Date',
            'created_on' => 'Created On',
            'user_id' => 'User ID',
            'account_from_date' => 'From Date',
            'account_to_date' => 'To Date'
        ];
    }

    public function getTotals($ids)	
    {
        if($ids){
        $ids = implode(",",$ids);
        $connection=Yii::app()->db;
        $command=$connection->createCommand("SELECT SUM(amount) FROM `ezl_account` where account_id in ($ids)");
        $amount = $command->queryScalar();
        return "R$ ".Yii::app()->format->formatNumber($amount);
        }
        else 
        return 0;
    }
}
