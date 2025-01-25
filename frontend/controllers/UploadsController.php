<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Uploads;
use frontend\models\UploadsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseFileHelper;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

use frontend\models\Transducers2;

//use frontend\models\Importedcsvdata;
//use frontend\models\Dncimporteddata;

//use PhpOffice\PhpSpreadsheet\Spreadsheet;
//use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
//use PhpOffice\PhpSpreadsheet\Writer\Csv;
use frontend\models\ExportForm;
//use frontend\models\Areacodes;

use Shuchkin\SimpleCSV;

/**
 * UploadsController implements the CRUD actions for Uploads model.
 */
class UploadsController extends Controller
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
     * Lists all Uploads models.
     * @return mixed
     */
    public function actionIndex()
    {   
        //$exportForm = new ExportForm();
        $searchModel = new UploadsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    
        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }
    
   /**
     * Creates a new Uploads model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Uploads();

        if($model->load(Yii::$app->request->post())){
            $upload = UploadedFile::getInstance($model, 'file');
            if (!empty($upload)) {
				
                $alias = Yii::getAlias("@frontend/web/uploads/transducers");
                BaseFileHelper::createDirectory($alias);
                $filename = time(); 
                $name = $filename . '.' . $upload->extension;
                $path = $alias . DIRECTORY_SEPARATOR . $name;
                $model->file = $name;
                
                $upload->saveAs($path);
			}  
            
            $model->upload_date = date("Y-m-d h:i:s");
            $model->file_name = $upload->name;
            //if($model->description==''){$model->description = $model->file_name;}
            //$model->upload_type = 1;
           // $model->status = 1; 
            //$model->import_mapping = '';
            
            if($model->save()) {
                
                
                
                
              if($csv = SimpleCSV::parse($path, false)){
                
                $oSheet = $csv->rows();
                $i = 0;
                foreach($oSheet as $row){
                    if($i==0){
                        $headers = $row;
                        //var_dump($headers);
                        //exit;
                    }else{
                    
                    //if( ($model->the_first_row_is_header==1 && $i>1) || $model->the_first_row_is_header==0){
                    //if($i>$model->the_first_row_is_header-1){
                    $transducers2 = new Transducers2();
                    $column_names = $transducers2->getAttributes(); 
                    $cn = [];
                    foreach($column_names as $key => $c){
                        $cn[]=$key;
                        }
                    $transducers2->upload_id = $model->id;
                   
                 // var_dump($cn);
              //exit;
                    //foreach($row as $cell){
                        $j = 0;
                       // foreach($column_names as $key => $c){
                       foreach($headers as $key => $c){     // 
                            
                            //if($j>0){
                               // var_dump($row[$j]);
              //exit;
                            if(in_array($c, $cn)){
                                
                                if($c=='EntryDate'){
                                    $row[$key] = date("Y-m-d H:i:s", strtotime($row[$key]));
                                }
                                
                                $transducers2->{trim($c)}= (isset($row[$key]))?$row[$key]:'';
                                }
                            //}
                            
                            $j++;
                        }
                        
                      if(!$transducers2->save()){ 
                       print_r($transducers2->getErrors());
                       var_dump($transducers2->errors);
                       exit;
                    }
                    
                    
                    
                  }  
                        
                    //}
                    $i++;
                
                    
                }
                
                
                
                
                }
              
              
              
              
              
              //var_dump($oSheet);
              //exit;

      //Reads select period and age range of tables
       //$d['nSP'] = Self::cell($oSheet, 6, 3); // oSheet.Cells(6, 3)
       //$d['xMin'] = Self::cell($oSheet, 7, 3); // oSheet.Cells(7, 3)
       //$d['xMax'] = Self::cell($oSheet, 7, 4); //oSheet.Cells(7, 4)
       //$d['wMax'] = Self::cell($oSheet, 8, 3); //oSheet.Cells(8, 3)  
                
                
                
                
                
                
                
                
                
            return $this->redirect(['uploads/index']);    
            //return $this->redirect(['view', 'id' => $model->id]);
        }}

        return $this->render('create', ['model' => $model]);
    }    
    
    
    public static function cell($sheet, $row, $column){
       return $sheet[$row-2][$column-2];
    }    
 
    /**
     * Displays a single Uploads model.
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
     * Updates an existing Uploads model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if($model->load(Yii::$app->request->post()) && $model->save()){return $this->redirect(['view', 'id' => $model->id]);}
        return $this->render('update', ['model' => $model]);
    }

    /**
     * Deletes an existing Uploads model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model= $this->findModel($id);
        
        Transducers2::deleteAll("upload_id = $id");
        
        $path = Yii::getAlias("@frontend/web/uploads/transducers") . DIRECTORY_SEPARATOR . $model->file;   
        if($model->file && file_exists($path)){unlink($path);}
        
        $model->delete();
                
        return $this->redirect(['index']);
    }

    /**
     * Finds the Uploads model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Uploads the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Uploads::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    protected function phone_num_format($number){
        $number = preg_replace("/[^\d]/","",$number);
        if(strlen($number) >= 10){$number = preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "$1$2$3", $number);}
        return $number;
    }
}
