<?php
namespace backend\models;
//use app\models\UserTeam;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * This is the model class for table "mtt_user".
 *
 * @property integer $user_id
 * @property string $username
 * @property string $password
 * @property string $name
 * @property string $contact_no
 * @property string $email
 * @property integer $status
 * @property string $profile_image
 * @property string $auth_key
 * @property string $created_at
 * @property string $updated_at
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	public $current_pass,$new_pass,$retype_pass;
    public $create_password, $confirm_password, $admin_user;
	public $file;
    public static function tableName()
    {
        return '{{%user}}';
    }
	
	public function beforeSave($insert)
	{
	     if (parent::beforeSave($insert)) {
		    if($insert)
			   $this->created_at = date('Y-m-d H:i:s');
			   $this->updated_at = date('Y-m-d H:i:s');
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
            [['name'], 'required'],
            ['username', 'unique'],
            [['status'], 'integer'],
			[['current_pass', 'new_pass', 'retype_pass'], 'required','on'=>'change','message'=>''],
			['current_pass','checkOldPassword','on'=>'change','message'=>''],
			['retype_pass', 'compare','compareAttribute'=>'new_pass'],
            
            [['user_type', 'username', 'password', 'contact_no', 'dob', 'age', 'place_id','address', 'blood_group_id', 'gender', 'status', 'email',  'profile_image', 'auth_key', 'user_type', 'created_at', 'updated_at','is_parent', 'department_id', 'title'], 'safe'],
            

			[['profile_image'], 'file'],
            [['username', 'name', 'email', 'auth_key'], 'string', 'max' => 100],
            [['password', 'contact_no', 'profile_image'], 'string', 'max' => 50],
			['confirm_password', 'compare','compareAttribute'=>'create_password', 'on'=>'firstTime'],
			[['create_password', 'confirm_password'], 'required', 'on'=>'firstTime'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'File No.',
            'username' => 'Username',
            'password' => 'Password',
            'name' => 'Name',
            'contact_no' => 'Contact No',
            'email' => 'Email',
            'gender' => 'Gender',
            'dob' => 'Date of birth',
            'blood_group_id' => 'Blood Group',
            'status' => 'Status',
            'profile_image' => 'Profile Image',
            'auth_key' => 'Auth Key',
            'user_type' => 'User Type',
            'is_parent' => 'Your Team Manager',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'title' => 'Title',
            'department_id' => 'Department',
            'place_id' => 'Place',
            'age' => 'Age'
        ];
    }
	
	
	public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        if (Yii::$app->getSecurity()->validatePassword($password, $user->password) == true) {
    /* Password is valid */
		} else {
			/* Invalid password */
		}
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
   
    /**
     *  @ check old password is correct or wrong.
     */
    public function checkOldPassword($attribute,$params)
    {
	$record = User::find()->where(['password'=>$this->current_pass])->one();

	  if($record === null) {
		$this->addError($attribute, 'Invalid or Wrong password');
	 }  
    }
	
	public static function getUsrPhoto($id)
    {
	   $profile_image = $fWebPath=$_SERVER["HTTP_HOST"].'mamabrass/upload/profile/'.$id ? true :false;
	   return Yii::getAlias('')."/mamabrass/upload/profile/".(($profile_image) ? $id : "no_images_view_profile.png");
    }

	public static function getAdmPhoto($imgName)
    {
	   if(empty($imgName))
       {
            return Yii::getAlias('')."/mamabrass/upload/profile/no_images_view_profile.png";
       }else{
            return Yii::getAlias('').'/mamabrass/upload/profile/'.$imgName;
       }
    }

    public function getTeamList() { 
        $models = User::find()->where(['is_parent'=>NULL])->all();
        return ArrayHelper::map($models, 'user_id', 'name');
    }
    public function getUserType() {
        $userTypes=['1'=>'Doctor','2'=>'Receptionist',3=>'Nurse',4=>'Patiest'];
        if(isset($this->user_type) && !empty($this->user_type))
        {
            return $userTypes[$this->user_type];
        }
    }
    public function getUserMember()
    {
        if($this->is_parent)
        {
            return User::findOne($this->is_parent)->name;
        }else{
            return '';
        }
    }

    public static function getUserName($id){
        $model = User::find()->where(["user_id" => $id])->one();
        if(!empty($model)){
            return $model->name;
        }
        return '';
    }
}
