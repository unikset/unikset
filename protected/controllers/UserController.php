<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
				'actions'=>array('index','view','login','registration'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','logout'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
        /**
         * Аутентификация пользователя
         */
        public function actionLogin()
        {
            /**
             * Если пользователь аутентифецирован перенаправляем его на главную
             */
            if(!Yii::app()->user->isGuest)
            {
                $this->redirect(Yii::app()->homeUrl);
            }
            
            $model=new LoginForm;

            // if it is ajax validation request
            if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
            {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
            }

            /**
             * Собираем данные введенные пользователем в форме аутентификации
             */
            if(isset($_POST['LoginForm']))
            {
                    $model->attributes=$_POST['LoginForm'];
                    /**
                     * Проверяем данные и редиректим на предыдущую страницу если данные верны
                     */
                    if($model->validate() && $model->login())
                    {
                        $this->redirect(Yii::app()->user->returnUrl);
                    }
                            
            }
            /**
             * Показываем форму аутентификации
             */
            $this->render('login',array('model'=>$model));
        }
        
        /**
	 * Выход текущего пользователя и редирект его на главную страницу
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

        /**
	 * Просмотр данных одного пользователя
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Регистрация нового пользователя
	 * Если регистрация прошла успешно, редирект на страницу пользователя
	 */
	public function actionRegistration()
	{
            /**
             * Если пользователь аутентифецирован перенаправляем его на главную
             */
            if(!Yii::app()->user->isGuest)
            {
                $this->redirect(Yii::app()->homeUrl);
            }
            
            $model=new User;

            // Раскомментировать если требуется АЯКС валидация
            // $this->performAjaxValidation($model);

            /**
             * Если обращение к действию произошло методом POST
             * Зполняем атрибуты модели данными и сохраняем их
             */
            if(isset($_POST['User']))
            {
                    $model->attributes=$_POST['User'];

                    //Генерируем уникальную соль для пользователя
                    $model->salt = uniqid('',true);

                    //Хешируем пароль с помощью метода шифрования md5
                    $model->password = $model->hashPassword($model->password,$model->salt);

                    //Хешируем ключ активации
                    $model->activkey = User::encrypting();

                    //Присваиваем по умолчанию роль "пользователь"
                    $model->id_role = 1;

                    if($model->save())
                    {
                        $this->redirect(array('view','id'=>$model->id));
                    }

            }
            /**
             * Показываем форму регистрации
             */
            $this->render('create',array(
                    'model'=>$model,
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

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
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
		$dataProvider=new CActiveDataProvider('User');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

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
		$model=User::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
