<?php

namespace frontend\controllers;

use Yii;

use frontend\models\Targets;
use frontend\models\TargetsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\filters\AccessControl;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;

use Shuchkin\SimpleCSV;

/**
 * TargetsController implements the CRUD actions for Targets model.
 */
class TargetsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
            
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
            ]
        );
    }

    /**
     * Lists all Targets models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TargetsSearch();
        
        
        $user_group = Yii::$app->user->identity->user_group; 
        if($user_group==2){$searchModel->entered_by = Yii::$app->user->id;} 
        
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Targets model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Targets model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Targets();

        if ($this->request->isPost){
            if ($model->load($this->request->post())){
                
                
            $model->entry_time = date("Y-m-d h:i:s");
            $model->updated = date("Y-m-d h:i:s"); 
            
            //target_curve//
            $upload = UploadedFile::getInstance($model, 'target_curve');
            if (!empty($upload)) {
                $alias = Yii::getAlias("@frontend/web/uploads/target_curves");
                BaseFileHelper::createDirectory($alias);
                $name = time() . '.' . $upload->extension;
                $path = $alias . DIRECTORY_SEPARATOR . $name;
                $model->target_curve = $name;
                
                $model->file_name = $upload->name; 
                
                $upload->saveAs($path);  
			}                
                
        if($model->save()){
                    //return $this->redirect(['view', 'id' => $model->id]);
                    return $this->redirect(['index']);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Targets model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $file_target_curve = $model->target_curve;

        if ($this->request->isPost && $model->load($this->request->post())){
            $model->updated = date("Y-m-d h:i:s");
            
            //target_curve//
            $upload = UploadedFile::getInstance($model, 'target_curve');
            if($upload){
                if(!empty($file_target_curve)) {
                $path1 = Yii::getAlias("@frontend").'/web/uploads/target_curves/'.$file_target_curve;
                if(file_exists($path1)){unlink($path1);}
                }

                $alias = Yii::getAlias("@frontend/web/uploads/target_curves");
                BaseFileHelper::createDirectory($alias);
                $name = time() . '.' . $upload->extension;
                $path = $alias . DIRECTORY_SEPARATOR . $name;
                $model->target_curve = $name; 
                $model->file_name = $upload->name;            
                $upload->saveAs($path);
			}else{$model->target_curve = $file_target_curve;}

            if($model->save()) {
                //return $this->redirect(['view', 'id' => $model->id]);
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Targets model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id); //->delete();
   
        $target_curve_path = Yii::getAlias("@frontend/web/uploads/target_curves") . DIRECTORY_SEPARATOR . $model->target_curve;   
        if($model->target_curve && file_exists($target_curve_path)){unlink($target_curve_path);}
        
        $test_signal_path = Yii::getAlias("@frontend/web/uploads/test_signals") . DIRECTORY_SEPARATOR . $model->test_signal;   
        if($model->test_signal && file_exists($test_signal_path)){unlink($test_signal_path);}
        
        $data_sheet_path = Yii::getAlias("@frontend/web/uploads/data_sheets") . DIRECTORY_SEPARATOR . $model->data_sheet;   
        if($model->data_sheet && file_exists($data_sheet_path)){unlink($data_sheet_path);}
                 
        $model->delete();
        
        return $this->redirect(['index']);
    }

    /**
     * Finds the Targets model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Targets the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Targets::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
