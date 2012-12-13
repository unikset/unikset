<?php
/**
 * Управление университетами
 */
class UniversitiesController extends DashController
{
	/**
         * default action
         */
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
			array('allow', // allow admin user to perform all actions
				'actions'=>array(
                                    'index',
                                    'view',
                                    'create',
                                    'update',
                                    'admin',
                                    'delete',
                                    'getRegions',
                                    'getCities',
                                    'importCsv',
                                    ),
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
		$model=new Universities();
                
                //$criteria = new CDbCriteria();
                //$criteria->compare('type_id', 2);  
                
                $country = Countries::model()->findAll();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                
                
		if(isset($_POST['Universities']))
		{
                    //echo CVarDumper::dump($_POST, 10, TRUE); exit;
                    
                    /**
                     * если id страны не пустой
                     */
                    if ($_POST['Country_id'])
                    {
                        /**
                         * Если id региона не пустой
                         */
                        if($_POST['Region_id'])
                        {
                            /**
                             * Если есть идентификатор города в массиве Universuties
                             * то заполняем атрибуты модели универа и сохраняем универ
                             */
                            if($_POST['Universities']['location_id'])
                            {
                                $model->attributes = $_POST['Universities'];
                                if($model->save())
                                {
                                    $this->redirect(array('view','id'=>$model->id));
                                }
                            }
                            else
                            {
                                ////Если location_id пришел пустой, значит 
                                //должен быть город заполнен и id региона есть
                                //Сохраняем город и получаем id сохраненной записи
                                $city = new Cities();
                                $city->city = $_POST['City'];
                                $city->region_id = $_POST['Region_id'];
                                $city->country_id = $_POST['Country_id'];
                                if($city->save())
                                {
                                    $location_id = $city->id;
                                    //Заполняем атрибуты модели универа и сохраняем
                                    $model->attributes = $_POST['Universities'];
                                    $model->location_id = $location_id;
                                    if($model->save())
                                    {
                                        $this->redirect(array('view','id'=>$model->id));
                                    }
                                }
                                
                            }
                        }
                        else
                        {
                            /**
                             * Если id региона пустой значит заполнено поле Region
                             * И нужно сохранить регион
                             */
                            $region = new Regions();
                            $region->region = $_POST['Region'];
                            $region->country_id = $_POST['Country_id'];
                            if($region->save())
                            {
                                $region_id = $region->id;
                                
                                /**
                                 * И затем сохраняем город
                                 */
                                $city = new Cities();
                                $city->city = $_POST['City'];
                                $city->region_id = $region_id;
                                $city->country_id = $_POST['Country_id'];
                                if($city->save())
                                {
                                    $location_id = $city->id;
                                    //Заполняем атрибуты модели универа и сохраняем
                                    $model->attributes = $_POST['Universities'];
                                    $model->location_id = $location_id;
                                    if($model->save())
                                    {
                                        $this->redirect(array('view','id'=>$model->id));
                                    }
                                }
                                
                            }
                            
                        }
                    }
                    else
                    {
                        /**
                         * Если страна пришла из текстового поля, а не из 
                         * списка работаем с этим блоком
                         */
                        $country = new Countries();
                        $country->country = $_POST['Country'];
                        if($country->save())
                        {
                            $id_country = $country->id;
                        
                            $region = new Regions();
                            $region->region = $_POST['Region'];
                            $region->country_id = $id_country;
                            if($region->save())
                            {
                                $region_id = $region->id;

                                $city = new Cities();
                                $city->city = $_POST['City'];
                                $city->region_id = $region_id;
                                $city->country_id = $id_country;
                                if($city->save())
                                {
                                    $location_id = $city->id;

                                    //Заполняем атрибуты модели универа и сохраняем
                                    $model->attributes = $_POST['Universities'];
                                    $model->location_id = $location_id;
                                    if($model->save())
                                    {
                                        $this->redirect(array('view','id'=>$model->id));
                                    }  
                                }
                                
                            }
                            
                        }
                                    
                    }
		}

		$this->render('create',array(
			'model'=>$model,
                        'country'=>$country,
		));
	}

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

		if(isset($_POST['Universities']))
		{
			$model->attributes=$_POST['Universities'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
        
        public function actionGetRegions()
        {
            if(isset($_POST['Country_id']))
            {
                $id_country = Yii::app()->request->getPost('Country_id');
                
                $criteria = new CDbCriteria();
                $criteria->compare('country_id', $id_country);
                
                $data = Regions::model()->findAll($criteria);
                
                $array_data = CHtml::listData($data, 'id', 'region');  
                
                if($array_data)
                {
                    $dropdownRegion = CHtml::tag('option', array('value' => ''), 'Select region...', true);  ;  
                }
                else
                {
                    $dropdownRegion = '';
                }
                

                foreach($array_data as $value => $name)  
                {  
                    $dropdownRegion .= CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);  
                }  
                
                echo CJSON::encode(array(  
                    'dropdownRegion'=>$dropdownRegion  
                ));  
                Yii::app()->end();
            }
        }
        
        public function actionGetCities()
        {
            if(isset($_POST['Region_id']))
            {
                $id_region = Yii::app()->request->getPost('Region_id');
                
                $criteria = new CDbCriteria();
                $criteria->compare('region_id', $id_region);

                
                $data = Cities::model()->findAll($criteria);
                
                $array_data = CHtml::listData($data, 'id', 'city');  
                
                if($array_data)
                {
                    $dropdownCity = CHtml::tag('option', array('value' => ''), 'Select city...', true);  
                }
                else
                {
                    $dropdownCity = '';
                }
                

                foreach($array_data as $value => $name)  
                {  
                    $dropdownCity .= CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);  
                }  
                
                echo CJSON::encode(array(  
                    'dropdownCity'=>$dropdownCity  
                ));  
                Yii::app()->end();
            }
        }
        
        public function actionImportCsv()
        {
            //Если файл загружен
            if( isset($_FILES['csvfile']) ) 
            {
                 //Получаем дескриптор файла для чтения
                 //$handle = fopen($_FILES['csvfile']['tmp_name'], 'r');
                
                //Читаем файл csv в массив
                $csv_array = file($_FILES['csvfile']['tmp_name']);

                if($csv_array)
                 {
                     $tmp = array();
                     /**
                      * Перебираем полученный массив
                      */
                     foreach ($csv_array as $str)
                     {
                         mb_detect_order('Windows-1251,ASCII,UTF-8');
                         $str = mb_convert_encoding($str, 'UTF-8', mb_detect_encoding($str));
                         $line = explode(';', $str);
                         //echo CVarDumper::dump(mb_detect_encoding($line[0]), 10, true); exit;
                         /**
                          * Получаем модель университетов
                          */
                         $university = new Universities();
                         
                         /**
                          * Проверяем есть ли такая страна уже в базе данных
                          * Если есть извлекаем id страны
                          * Если нет, сохраняем новую страну и получаем ее id
                          */
                         $country = Countries::model()->find("country = '".$line[5]."'");
                         if($country)
                         {
                             //echo CVarDumper::dump($line, 10, TRUE); exit;
                             /**
                              * Еслитакая страна уже есть в бд, 
                              * Получем ее идентификатор
                              */
                             $id_country = $country->id;
                             
                             /**
                              * Проверяем есть ли такой регион в бд
                              * Если есть извлекаем его id
                              * Если нет, сохраняем регион в бд и получаем его id
                              */
                             $region = Regions::model()->find("region = '".$line[4]."'");
                             if($region)
                             {
                                 $id_region = $region->id;
                                 
                                 /**
                                  * Проверяем есть ли такой город в бд
                                  * Если есть, то извлекаем id города 
                                  * и сохраняем университет с этим городом
                                  */
                                 $city = Cities::model()->find("city = '".$line[3]."'");
                                 if($city)
                                 {
                                     //echo mb_detect_encoding($line[1]); exit;
                                     $id_city = $city->id;
                                     $university->title       = $line[0];
                                     $university->title_short = $line[1];
                                     $university->description = $line[2];
                                     $university->location_id = $id_city;
                                     if(!$university->save())
                                     {
                                         $errors[]='Невозможно сохранить университет - '.$line[0]. $university->errors;;
                                     }
                                 }
                                 else
                                 {
                                     $locations = new Cities();
                                     /**
                                      * Сохраняем город в бд 
                                      * Получаем id
                                      * И сохраняем универ
                                      */
                                     $locations->region_id = $id_region;
                                     $locations->country_id = $id_country;
                                     $locations->city     = $line[3];
                                     if($locations->save())
                                     {
                                         $id_city = $locations->id;
                                         
                                         $university->title       = $line[0];
                                         $university->title_short = $line[1];
                                         $university->description = $line[2];
                                         $university->location_id = $id_city;
                                         if(!$university->save())
                                         {
                                             $errors[]='Error1';
                                         }
                                     }
                                 }
                                 
                             }
                             else
                             {
                                 /**
                                  * Если нет региона в бд
                                  */
                                 $locations = new Regions();
                                 
                                 
                                 $locations->country_id = $id_country;
                                 $locations->region     = $line[4];
                                 
                                 if($locations->save())
                                 {
                                     $id_region = $locations->id;
                                     
                                     $cities = new Cities();
                                     /**
                                      * И сохраняем город в бд
                                      */
                                     $cities->region_id = $id_region;
                                     $cities->country_id = $id_country; 
                                     $cities->city     = $line[3];

                                     if($cities->save())
                                     {
                                         /**
                                          * Получаем id размещения университета и сохраняем университет в бд
                                          */
                                         $university_location_id = $cities->id;
                                         
                                         $university->title       = $line[0];
                                         $university->title_short = $line[1];
                                         $university->description = $line[2];
                                         $university->location_id = $university_location_id;
                                         if(!$university->save())
                                         {
                                             $errors[]='Error1';
                                         }
                                     }
                                 }
                             }
                             
                             
                         }
                         else
                         {
                             /**
                              * Если нет такой страны
                              */
//                             echo 'Нет такой страны';
//                             echo CVarDumper::dump($line, 10, TRUE); exit;
                             $countries = new Countries();
                              
                             $countries->country     = $line[5];

                             if($countries->save())
                             {
                                 $id_country = $countries->id;
                                 
//                                 echo 'Нет такой страны - '.$parent;
//                                 echo CVarDumper::dump($line, 10, TRUE); exit;
                                 $regions = new Regions();
                                 /**
                                  * Сохраняем регион
                                  */
                                 $regions->country_id = $id_country;
                                 $regions->region     = $line[4];

                                 if($regions->save())
                                 {
                                     $id_region = $regions->id;
                                     
//                                     echo 'Нет такой страны - '.$parent;
//                                 echo CVarDumper::dump($line, 10, TRUE); exit;
                                     $cities = new Cities();
                                     /**
                                      * Сохраняем город
                                      */
                                     $cities->country_id = $id_country;
                                     $cities->region_id = $id_region;
                                     $cities->city     = $line[3];

                                     if($cities->save())
                                     {
                                         /**
                                          * Получаем id местонахождения университета
                                          */
                                         $university_location_id = $cities->id;
                                         
                                         /**
                                          * Сохраняем университет
                                          */
                                         $university->title       = $line[0];
                                         $university->title_short = $line[1];
                                         $university->description = $line[2];
                                         $university->location_id = $university_location_id;
                                         if(!$university->save())
                                         {
                                             $errors[]='Error1';
                                         }
                                     }
                                 }
                             }
                         }
                     }        
                 }
                 //fclose($handle);
                 if(!$errors)
                 {
                     $this->redirect(array('admin'));
                 }
                 else
                 {
                     echo CVarDumper::dump($errors, 10, TRUE);exit;
                 }
            }
            //Если файла еще нет выводим форму загрузки файла
            $this->render('upload_form');
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
		$dataProvider=new CActiveDataProvider('Universities');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Universities('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Universities']))
			$model->attributes=$_GET['Universities'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Universities::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='universities-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
