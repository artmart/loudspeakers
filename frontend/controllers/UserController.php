<?php
namespace frontend\controllers;

use Yii;
use frontend\models\User;
use frontend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
        'access' => [
                'class' => AccessControl::className(),
                //'only' => ['logout', 'signup', 'index'],
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'view', 'delete', 'index'],
                        'allow' => true,
                        'roles' => ['@'],

                        //'matchCallback' => function ($rule, $action) {
                        //    return Yii::$app->user->identity->user_group==1;
                        //}
                        
                        
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
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
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())){
            
            $decoded_password = $model->password;
            $model->setPassword($model->password);
            $model->generateAuthKey();
            $model->generateEmailVerificationToken();
            $model->created_at = time();
            $model->updated_at = time(); 
            
            
            $upload = UploadedFile::getInstance($model, 'profile_photo');
            
            if (!empty($upload)) {
				
                $alias = Yii::getAlias("@frontend/web/uploads");
                BaseFileHelper::createDirectory($alias);
                $filename = time(); 
                $name = $filename . '.' . $upload->extension;
                $path = $alias . DIRECTORY_SEPARATOR . $name;
                $model->profile_photo = $name;
                
                $upload->saveAs($path);
			}  
            
           if($model->save()){
                $content = 'Dear '.$model->firstname.' '.$model->lastname.'<br/><br/>';
                $content .= 'Your account has been created with these credentials:<br/>';
                $content .= 'Email: '. $model->email.'<br/>';  
                $content .= 'Password: '. $decoded_password.'<br/>'; 
                //$content .= '(Note: You can change the password after logging in)<br/>';                    
                     
                    Yii::$app->mailer->compose('layouts/html', ['content'=>$content])
                        ->setTo($model->email)
                        ->setFrom(Yii::$app->params['senderEmail'])
                        ->setSubject('Your account has been created')
                        //->setTextBody($content)
                        ->setHtmlBody($content)
                        ->send();
            
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $file = $model->profile_photo;

        if ($model->load(Yii::$app->request->post())){
            if(!empty($model->password)){$model->setPassword($model->password);}
            $model->updated_at = time(); 
            
            
            $upload = UploadedFile::getInstance($model, 'profile_photo');
            
            if($upload){
                if(!empty($file)) {
                $path1 = Yii::getAlias("@frontend").'/web/uploads/'.$file;
                if(file_exists($path1)){unlink($path1);}
                }

                $alias = Yii::getAlias("@frontend/web/uploads");
                BaseFileHelper::createDirectory($alias);
                $filename = time(); 
                $name = $filename . '.' . $upload->extension;
                $path = $alias . DIRECTORY_SEPARATOR . $name;
                $model->profile_photo = $name;
                                    
                $upload->saveAs($path);
			}else{$model->profile_photo = $file;}
            
            
            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {   
        $logout = true;
        if(Yii::$app->user->identity->user_group==1 && Yii::$app->user->id!==$id){$logout = false;}
        $user = $this->findModel($id);
        
        $photo_path = Yii::getAlias("@frontend/web/uploads") . DIRECTORY_SEPARATOR . $user->profile_photo;   
        if($user->profile_photo && file_exists($photo_path)){unlink($photo_path);}
                 
        $user->delete();
        
        //$this->findModel($id)->delete();
        if(!$logout){
            return $this->redirect(['index']);
            }else{
                Yii::$app->user->logout();
                return $this->goHome();
            }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
