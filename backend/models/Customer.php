<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%customer}}".
 *
 * @property integer $customer_id
 * @property string $company_name
 * @property string $tel_no
 * @property string $mob_no
 * @property string $contact_person
 * @property string $created_on
 * @property string $updated_on
 * @property integer $user_id
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%customer}}';
    }

    public function beforeSave($insert)
	{
	     if (parent::beforeSave($insert)) {
		    if($insert)
			   $this->created_on = date('Y-m-d H:i:s');
			   $this->updated_on = date('Y-m-d H:i:s');
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
            [['company_name', 'mob_no', 'contact_person'], 'required'],
            [['tel_no', 'address', 'created_on', 'updated_on', 'created_on', 'user_id'], 'safe'],
            [['user_id'], 'integer'],
            [['company_name'], 'string', 'max' => 300],
            [['tel_no'], 'string', 'max' => 30],
            [['mob_no'], 'string', 'max' => 15],
            [['contact_person'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customer_id' => 'Customer ID',
            'company_name' => 'Company Name',
            'address' => 'Address',
            'tel_no' => 'Telephone No',
            'mob_no' => 'Mobile No',
            'contact_person' => 'Contact Person',
            'created_on' => 'Created On',
            'updated_on' => 'Updated On',
            'user_id' => 'User ID',
        ];
    }

    public function getName($id)
    {
        if(isset($id) && !empty($id))
        {
            $customer=Customer::find()->where(["customer_id"=>$id])->one();
            if($customer)
            {
                return $customer->company_name;
            }else{
                return "";
            }
        }else{
            return "";
        }
    }
}
