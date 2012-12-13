<?php

class LocationsController extends DashController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';
        
        public $defaultAction = 'admin';

        /**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'create','update', 'admin','delete', 'importCsv'),
				'roles'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Locations;
                
                //$types = LocationTypes::model()->findAll();
                $types = LocationTypes::model()->findAll();
                
                $parents = Locations::model()->getParent();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Locations']))
		{
			$model->attributes=$_POST['Locations'];
                        if(!$model->parent_id)
                        {
                            $model->parent_id = -1;
                        }
			if($model->save())
                        {
                            $this->redirect(array('view','id'=>$model->id));
                        }
				
		}

		$this->render('create',array(
			'model'=>$model,
                        'location_types'=>$types,
                        'parents'=>$parents,
		));
	}
        
//        public function actionImportCsv()
//        {
//            
//            
//            //Если файл загружен
//            if( isset($_FILES['csvfile']) ) 
//            {
//                 //Получаем дескриптор файла для чтения
//                 $handle = fopen($_FILES['csvfile']['tmp_name'], 'r');
//
//                 if ($handle) 
//                 {
//                     $tmp = array();
//                     //Если дескриптор получен, читаем файл
//                     while( ($line = fgetcsv($handle, 0, ";")) != FALSE) 
//                     {
//                         $model = new Locations();
//                         $model->parent_id     = $line[0];
//                         $model->title         = $line[1];
//                         $model->type_id       = $line[2];
//                          //echo CVarDumper::dump($model, 10, TRUE);exit;
//                         if(!$model->save())
//                         {
//                             break;
//                             $errors[] = "Произощла ошибка при сохранении записи.";
//                         }
//                     }        
//                 }
//                 fclose($handle);
//                 if(!$errors)
//                 {
//                     $this->redirect(array('admin'));
//                 }
//            }
//            
//            $this->render('upload_form');
//        }

        /**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Locations']))
		{
			$model->attributes=$_POST['Locations'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Locations');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$countries = new Countries('search');
                //echo CVarDumper::dump($countries, 10, TRUE); exit;
                $regions = new Regions('search');
                $cities = new Cities('search');

		$this->render('admin',array(
			'countries'=>$countries,
                        'regions'=>$regions,
                        'cities'=>$cities,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Locations::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='locations-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
