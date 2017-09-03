<?php

namespace backend\controllers;

use Yii;
use backend\models\User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;	
/**
 * UserController implements the CRUD actions for mttUser model.
 */
class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all mttUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single mttUser model.
     * @param integer $id
     * @return mixed
     */
    
    public function actionView($id)
    {
        $model = $this->findModel($id);

       return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new mttUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        if ($model->load(Yii::$app->request->post())) {
            if(isset($model->profile_image) && !empty($model->profile_image))
            {
                $model->file = UploadedFile::getInstances($model, 'profile_image');
                foreach ($model->file as $key => $file) {
                    $fPath=$_SERVER["DOCUMENT_ROOT"].'/mamabrass/upload/profile/';
                    $file->saveAs($fPath.$file->baseName . '.' . $file->extension);//Upload files to server
                    
                }
                $model->profile_image=$file->baseName . '.' . $file->extension; 
            }    

            $model->save();
            Yii::$app->session->setFlash('success', 'User Profile has been successfully Created!');
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing mttUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $old_profileimage=$model->profile_image;
        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstances($model, 'profile_image');
            
            if(isset($_FILES["User"]["name"]["profile_image"]) && !empty($_FILES["User"]["name"]["profile_image"]))
			{
				$model->file = UploadedFile::getInstances($model, 'profile_image');
				foreach ($model->file as $key => $file) {
					$fPath=$_SERVER["DOCUMENT_ROOT"].'/mamabrass/upload/profile/';
					$file->saveAs($fPath.$file->baseName . '.' . $file->extension);//Upload files to server
				}       
				$model->profile_image=$file->baseName . '.' . $file->extension; 
			}else{
				$model->profile_image=$old_profileimage; 
			}
            $model->save();
            Yii::$app->session->setFlash('success', 'Your Profile Image has been successfully updated!');
            return $this->redirect(['index']);
        }else{
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
	
	
	
	public function actionUpdate_password($id)
    {
		$model=$this->findModel(Yii::$app->user->id);
		$model->scenario = 'change';

		if(isset($_POST['User']))
		{
			$model->attributes = $_POST['User'];
			$user = User::findOne(Yii::$app->user->id);
			$model->password = $model->new_pass;
			if($model->save())
					return $this->redirect(['update', 'id' => $model->user_id]);
				    //Yii::$app->session->setFlash('success', 'Your Password has been successfully updated!');
					
		}
		return $this->render('update_password',[
			'model'=>$model,
		]);
    }
	

    /**
     * Deletes an existing mttUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the mttUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return mttUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
    public function actionCheckuser()
    {
		if(!empty($_REQUEST['name']) && !empty($_REQUEST['contact_no']))
		{
			$user = User::find()->where(['name' => $_REQUEST['name'], 'contact_no' => $_REQUEST['contact_no']])->count();
			echo $user;		
		}
    }

    public function actionGetuser()
    {
		if(!empty($_REQUEST['user_id']))
		{
			$user = User::find()->where(['user_id'=>$_REQUEST['user_id']])->one();
            if($user)
            {
                echo json_encode(array('status'=>true,'data'=>$user->attributes));
            }else{
                echo json_encode(array('status'=>false,'data'=>''));
            }		
		}
    }
}
