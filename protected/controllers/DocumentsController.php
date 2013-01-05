<?php
class DocumentsController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

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
            array('allow',
                'actions' => array('create', 'index', 'view', 'search', 'textSearch', 'tagSearch', 'getRegions', 'getCities', 'getUniversity', 'dynamiccat', 'dynamicuniflag', 'dynamiclecturer', 'dynamicuniver', 'dynamiclecturer2', 'dynamiclecturer_new'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'roles' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * Статусы документа
     * 0 - требует премодерации-не виден
     * 1 - требует постмдерации - виден
     * 2 - одобрен - прошел премодерацию  и постмодерацию
     * 3 - не одобрен - не виден никому
     */
    public function actionCreate()
    {
        /**
         * Подключение скриптов валидации на клиенте
         */
        Yii::app()->clientScript->registerCssFile(Yii::app()->assetManager->publish('css/').'/customMessages.css', 'screen'); 
        Yii::app()->clientScript->registerCssFile(Yii::app()->assetManager->publish('css/').'/validationEngine.jquery.css', 'screen');  
        Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish('js/'). '/languages/jquery.validationEngine-en.js', CClientScript::POS_HEAD);  
        Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish('js/'). '/jquery.validationEngine.js', CClientScript::POS_HEAD);  
        
        $model = new Documents('create');

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);
        
        /**
         * Если данные пришли из формы
         */
        if (isset($_POST['Documents']))
        {
            //echo CVarDumper::dump($_POST, 10, TRUE); exit;
            /**
             * Заполняем атрибуты модели документа из формы
             */
            $model->attributes = $_POST['Documents'];
            /**
             * Плучаем IP пользователя загрузившего документ
             */
            //$model->user_ip = CHttpRequest::getUserHostAddress();
            $model->user_ip = Yii::app()->request->getUserHostAddress();
            
            /**
             * Получаем объект загужаемого файла
             */
            $doc_instance = CUploadedFile::getInstance($model, 'file_name');
            
            //echo CVarDumper::dump($doc_instance, 10, TRUE); exit;
            /**
             * Если файл загружен
             */
            if($doc_instance)
            {
                /**
                 * Новое имя файла
                 */
                $art = md5(uniqid(rand(), 1));

                //echo CVarDumper::dump($art,10,true); exit;
                /**
                 * Сохраняем файл в директорию files корневой директории сайта
                 */
                $doc_instance->saveAs(Yii::getPathOfAlias('webroot') . '/files/' . $art . '_' . $doc_instance);
                /**
                 * Записываем имя файла в таблицу документов
                 */
                $model->file_name = $art . '_' . $doc_instance;
            }
            else
            {
                $model->link = $_POST['Documents']['link'];
            }
            
            /**
             * Если пользователь авторизован пишем в таблицу документов его id
             */
            if(!Yii::app()->user->isGuest)
            {
                $model->user_id = Yii::app()->user->id;
            }
            
            
            /**
             * Проверяем куда отправлять документ, на постмодерацию или на премодерацию
             */
            if(Yii::app()->user->isGuest)
            {
                /**
                 * Если пользователь не авторизован, ставим статус 0(отправить на премодерацию)
                 */
                $model->status = 0;
            }
            elseif (Yii::app()->user->role === 'admin' || Yii::app()->user->role === 'moderator')
            {
                /**
                 * Если документ загрузил модератор или админ
                 * Сразу ставим статус 2 одобрен
                 */
                $model->status = 2;
            }
            elseif (Yii::app()->user->role === 'user')
            {
                /**
                 * Если пользователь авторизован, ставим статус 1 (отправить на постмодерацию)
                 */
                $model->status = 1;
            }
            
            
            /**
             * Если документ сохранен, 
             * Сохраняем в промежуточную таблицу связку document-discipline
             * редиректим на страницу просмотра документа.
             */
            if ($model->save())
            {
                if($this->parseTags($model->id, $model->file_name, $model->link))
                {
                    $success='Теги сохранены';
                }
                /**
                 * Запись в смежную таблицу новая по этому создаем новый объект
                 */
                $discipline_document = new DisciplineDocuments();
                $discipline_document->discipline_id = $_POST['Discipline']['id'];
                $discipline_document->document_id   = $model->id;
                if($discipline_document->save())
                {
                    //echo CVarDumper::dump($discipline_document->id, 10, TRUE);exit;
                    if($_POST['Universities']['id'])
                    {
                        /**
                         * Запись в смежную таблицу Университет = Документ
                         */
                        $university_documents = new UniversityDocuments();
                        $university_documents->document_id = $model->id;
                        $university_documents->university_id = $_POST['Universities']['id'];
                        if($university_documents->save())
                        {
                            if($_POST['Lecturers']['id'])
                            {
                                /**
                                 * Пишем в смежную таблицу докумен - лекция
                                 */
                                $document_lecturers = new DocumentLecturers();
                                $document_lecturers->document_id = $model->id;
                                $document_lecturers->lecturer_id = $_POST['Lecturers']['id'];
                                if($document_lecturers->save())
                                {
                                    //echo CVarDumper::dump($document_lecturers->id, 10, TRUE);exit;
                                    Yii::app()->user->setFlash('message','Document is sent to the moderation'.$success);
                                    $this->redirect(Yii::app()->homeUrl);
                                }
                            }
                            elseif($_POST['Lecturers']['name'])
                            {
                                /**
                                 * Проверим на всякий случай есть ли лекция с таким названием
                                 * в таблице лекций
                                 */
                                $criteria = new CDbCriteria();
                                $criteria->compare('name', $_POST['Lecturers']['name']);
                                $exists_lectures = Lecturers::model()->find($criteria);
                                /**
                                 * Если лекция существует, сразу пишем в смежную
                                 * таблицу документ - лекция
                                 */
                                if($exists_lectures)
                                {
                                    /**
                                     * Пишем в смежную таблицу докумен - лекция
                                     */
                                    $document_lecturers = new DocumentLecturers();
                                    $document_lecturers->document_id = $model->id;
                                    $document_lecturers->lecturer_id = $exists_lectures->id;
                                    if($document_lecturers->save())
                                    {
                                        Yii::app()->user->setFlash('message','Document is sent to the moderation'.$success);
                                        $this->redirect(Yii::app()->homeUrl);
                                    }
                                }
                                else
                                {
                                    /**
                                     * Если лекции нет в таблице, значит это
                                     * Новая лекция нужно ее сохранить
                                     */
                                    $lecturers = new Lecturers();
                                    $lecturers->attributes = $_POST['Lecturers'];
                                    /**
                                     * Если у пользователя выбран язык в куках, пишем код языка в бд
                                     */
                                     $lecturers->lang = Yii::app()->language;
                                    
                                    /**
                                     * Проверяем куда отправлять документ, на постмодерацию или на премодерацию
                                     */
                                    if(Yii::app()->user->isGuest)
                                    {
                                        /**
                                         * Если пользователь не авторизован, ставим статус 0(отправить на премодерацию)
                                         */
                                        $lecturers->status = 0;
                                    }
                                    elseif (Yii::app()->user->role === 'admin' || Yii::app()->user->role === 'moderator')
                                    {
                                        /**
                                         * Если документ загрузил модератор или админ
                                         * Сразу ставим статус 2 одобрен
                                         */
                                        $lecturers->status = 2;
                                    }
                                    else 
                                    {
                                        /**
                                         * Если пользователь авторизован, ставим статус 1 (отправить на постмодерацию)
                                         */
                                        $lecturers->status = 1;
                                    }

                                    //echo CVarDumper::dump($lecturers->attributes, 10, TRUE);exit;

                                    if($lecturers->save())
                                    {
                                            /**
                                             * Если лекция сохранена
                                             * Пишем в смежную таблицу докумен - лекция
                                             */
                                            $document_lecturers = new DocumentLecturers();
                                            $document_lecturers->document_id = $model->id;
                                            $document_lecturers->lecturer_id = $lecturers->id;
                                            if($document_lecturers->save())
                                            {
                                                Yii::app()->user->setFlash('message','Document is sent to the moderation'.$success);
                                                $this->redirect(Yii::app()->homeUrl);
                                            }
                                    }
                                }
                                
                            }
                        }
                        
                    }
                    else
                    {
                        if($_POST['Lecturers']['id'])
                        {
                            /**
                             * Пишем в смежную таблицу докумен - лекция
                             */
                            $document_lecturers = new DocumentLecturers();
                            $document_lecturers->document_id = $model->id;
                            $document_lecturers->lecturer_id = $_POST['Lecturers']['id'];
                            if($document_lecturers->save())
                            {
                                //echo CVarDumper::dump($document_lecturers->id, 10, TRUE);exit;
                                Yii::app()->user->setFlash('message','Document is sent to the moderation'.$success);
                                $this->redirect(Yii::app()->homeUrl);
                            }
                        }
                        elseif($_POST['Lecturers']['name'])
                        {
                            /**
                             * Проверим на всякий случай есть ли лекция с таким названием
                             * в таблице лекций
                             */
                            $criteria = new CDbCriteria();
                            $criteria->compare('name', $_POST['Lecturers']['name']);
                            $exists_lectures = Lecturers::model()->find($criteria);
                            /**
                             * Если лекция существует, сразу пишем в смежную
                             * таблицу документ - лекция
                             */
                            if($exists_lectures)
                            {
                                 /**
                                  * Пишем в смежную таблицу докумен - лекция
                                  */
                                 $document_lecturers = new DocumentLecturers();
                                 $document_lecturers->document_id = $model->id;
                                 $document_lecturers->lecturer_id = $exists_lectures->id;
                                 if($document_lecturers->save())
                                 {
                                     Yii::app()->user->setFlash('message','Document is sent to the moderation'.$success);
                                     $this->redirect(Yii::app()->homeUrl);
                                 }
                            }
                            else
                            {
                                /**
                                 * Новая лекция нужно ее сохранить
                                 */
                                $lecturers = new Lecturers();
                                $lecturers->attributes = $_POST['Lecturers'];
                                /**
                                 * Если у пользователя выбран язык в куках, пишем код языка в бд
                                 */
                                $lecturers->lang = Yii::app()->language;
                                
                                /**
                                 * Проверяем куда отправлять документ, на постмодерацию или на премодерацию
                                 */
                                if(Yii::app()->user->isGuest)
                                {
                                    /**
                                     * Если пользователь не авторизован, ставим статус 0(отправить на премодерацию)
                                     */
                                    $lecturers->status = 0;
                                }
                                elseif (Yii::app()->user->role === 'admin' || Yii::app()->user->role === 'moderator')
                                {
                                    /**
                                     * Если документ загрузил модератор или админ
                                     * Сразу ставим статус 2 одобрен
                                     */
                                    $lecturers->status = 2;
                                }
                                else 
                                {
                                    /**
                                     * Если пользователь авторизован, ставим статус 1 (отправить на постмодерацию)
                                     */
                                    $lecturers->status = 1;
                                }

                                //echo CVarDumper::dump($lecturers->attributes, 10, TRUE);exit;

                                if($lecturers->save())
                                {
                                     /**
                                     * Пишем в смежную таблицу докумен - лекция
                                     */
                                    $document_lecturers = new DocumentLecturers();
                                    $document_lecturers->document_id = $model->id;
                                    $document_lecturers->lecturer_id = $lecturers->id;
                                    if($document_lecturers->save())
                                    {
                                        Yii::app()->user->setFlash('message','Document is sent to the moderation'.$success);
                                        $this->redirect(Yii::app()->homeUrl);
                                    }
                                }
                            }
                            
                        }
                    }
                    
                }
                
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Парсинг документа и сохранение тегов в таблицу Tags
     * Сохранение записей в связывающую таблицу Document_Tags
     * @param integer $id_document
     * @param string $filename
     * @param string $link
     */
    public function parseTags($id_document, $filename = null, $link = null)
    {
        /**
         * Импортируем классы расширения парсера пдф документов
         */
        Yii::import('application.extensions.docparser.*');
        
        /**
         * Если передано имя файла
         */
        if($filename)
        {
            /**
             * Получаем имя файла
             */
            $filename = $_SERVER['DOCUMENT_ROOT'].'/files/'.$filename;
        }
        /**
         * Если передана ссылка на файл
         */
        if($link)
        {
            /**
             * Получаем ссылку на файл
             */
            $filename = $link;
        }
        
        /**
         * Получаем контент(в linux заменить на соответствующий код)
         */
        $content = shell_exec('pdftotext '.$filename.' -');
	/**
         * Преобразуем кодировку
         */
        $content = mb_convert_encoding($content,'UTF-8');

        /**
         * Создаем объект парсера(с заданными кодировками)
         */
        $wp = new Text_WordsParser(array('Latin', 'Cyrillic'));
        
        /**
         * Получаем текст обработанный парсером
         */
        $text = $wp->parse($content, $words, $sentences, $uniques, $offset_map);

        /**
         * Получаем массив слов и их вес слово=>вес
         */
        $wes = $wp->weights($uniques);
        
        foreach ($wes as $k => $v)
        {
            /**
             * Если слово является числом, удаляем элемент массива
             */
            if(is_numeric($k))
            {
                unset($wes[$k]);
            }
            /**
             * Если длинна слова меньше трех символов, удаляем элемент массива
             */
            if(strlen($k)<3)
            {
                unset($wes[$k]);
            }
        }
        /**
         * Сохранение тегов в бд
         */
        $i=0;//инициалиируем счетчик
        foreach ($wes as $title => $weight)
        {
            /**
             * Проверяем тег на существование в таблице
             */
            $criteria = new CDbCriteria();
            $criteria->compare('title', $title);
            $exist_tag = Tags::model()->find($criteria);
            //Если тег есть, сохраняем данные только в таблицу Document_Tags
            if($exist_tag)
            {
                $tag_doc = new DocumentTags();
                $tag_doc->document_id = $id_document;
                $tag_doc->tag_id = $exist_tag->id;
                $tag_doc->weight = $weight;

                if(!$tag_doc->save())
                {
                    $errors[]=$tag_doc->errors;
                }
            }
            else
            {
                /**
                 * Если такого тега еще нет в таблице
                 * Записываем тег в таблицу
                 */
                $tag = new Tags();
                $tag_doc = new DocumentTags();

                $tag->title = $title;
                if($tag->save())
                {
                    /**
                     * Если тег сохранен записываем данные в связанную таблицу
                     */
                    $tag_doc->document_id = $id_document;
                    $tag_doc->tag_id = $tag->id;
                    $tag_doc->weight = $weight;

                    if(!$tag_doc->save())
                    {
                        $errors[]='Error - on '.$i++.' iteration saved Documents_Tags';
                    }
                }
                else
                {
                    $errors[] = 'Error insert tag on '.$i.' interation';
                }
            }
        }
        /**
         * Если есть ошибки выводим их для отладки
         */
        if(isset($errors))
        {
            echo CVarDumper::dump($errors, 10, TRUE);
            Yii::app()->end();
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Documents']))
        {
            $model->attributes = $_POST['Documents'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest)
        {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Documents');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }
    
    /**
     * Поиск документа
     */
    public function actionSearch()
    {
    	/*
    	* Подключаем filter.js
    	*/
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl. '/js/jquery-ui-1.8.16.custom.min.js', CClientScript::POS_HEAD);  
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl. '/js/filter.js', CClientScript::POS_HEAD);  
        /**
         * Создаем объект поиска документа
         */
        $doc = new Documents('search');
        
        /**
         * Очищаем все атрибуты по умолчанию
         */
        $doc->unsetAttributes();  // clear any default values
        
        $results = NULL;
        /**
         * Если пользователь нажал кнопку Search
         * Собираем параметры из массива POST
         */
        if (isset($_POST['Documents']))
        {
            //echo CVarDumper::dump($_POST, 10 ,true); exit;
            /**
             * Получаем текстовую строку
             */
            $q          = Yii::app()->request->getPost('query');
            $is_univer  = $_POST['Documents']['is_university_document']; 
            $city       = $_POST['Cities']['id']; 
            $region     = $_POST['Regions']['id'];
            $country    = $_POST['Countries']['id'];
            $university = $_POST['Universities']['id'];
            $discipline = $_POST['Discipline']['id']; 
            $lecturer   = $_POST['Lecturers']['id']; 
 
            
            $document = new Documents();
            $results = $document->advancedSearch($q,  $is_univer, $city, $region, $country, $university, $discipline, $lecturer);

        }
        $this->render('search', array(
            'doc' => $doc,
            'results'=>$results,
        ));
    }
    
    /**
     * Поиск по строке поиска. Производится по тегам документа.
     * В последствии оформить в виде обычного метода для включения в экшин search
     */
    public function actionTagSearch()
    {
        if(isset($_POST['query']))
        {
            $query_array = explode(' ', $_POST['query']);
            $criteria = new CDbCriteria();
            $criteria->with = 'documentTags';
            foreach ($query_array as $term)
            {
                $criteria->compare('title', $term, FALSE, 'OR');
            }
            $results = Tags::model()->findAll($criteria);
            
            $criteria2 = new CDbCriteria();
            
            $id_array = array();
            foreach ($results as $result)
            {
                foreach ($result->documentTags as $dt)
                {
                    $id_array[]=$dt->document_id;
                }
            }

            $criteria2->addInCondition('id', $id_array);
            $list = implode(',', $id_array);
            
            $doc_search=new CActiveDataProvider('Documents', array(
                            'criteria'=>array(
                                'condition'=>'id IN ('.$list.')',
                            ),
                            'pagination'=>array(
                            'pageSize'=>20,
                            ),
                        )
                    );
            
            $doc_search = Documents::model()->findAll($criteria2);
            //echo CVarDumper::dump($doc_search, 10, true);
        }


        $doc = new Documents();

        
        
        
        $this->render('search', array(
            'doc' => $doc,
            'doc_search' => $doc_search,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Documents('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Documents']))
            $model->attributes = $_GET['Documents'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = Documents::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
    
    public function actionCallLocationFilterForm()
    {
        $countries = new Countries('_docfilter');
        $countries->unsetAttributes();  // clear any default values
        if (isset($_GET['countries']))
            $countries->attributes = $_GET['countries'];
        $countries->findAll();
        $this->renderPartial('_docfilter', array(
            'countries' => $countries,
        ));
    }

    /*     * ****************************************************AJAX METHODS******************************************************* */

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'documents-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
    public function actionGetRegions()
    {
         $lect1 = NULL;
            /**
             * Если выбрана локация пытаемся вернуть данные в следующий выпадающий список
             */
            $loc1 = '<option value="">select an option</option>';
            /**
             * Это мы получаем регион
             */
            $data1 = Regions::model()->findAll(array(
                        'condition' => 'country_id=:country_id',
                        'params' => array(':country_id' => $_POST['country_id'],),
                        'order' => 'region ASC'
                         )
                    );
            /**
             * Формируем массив для выпадающего списка
             */
            $data1 = CHtml::listData($data1, 'id', 'region');
            
            if ($data1)
            {
                /**
                 * Если запрос вернул дочерние элементы локации, 
                 * формируем список опшинов
                 */
                foreach ($data1 as $value => $subcategory)
                {
                    $loc1 .=CHtml::tag('option', array('value' => $value), CHtml::encode($subcategory), true);
                }
                /**
                 * Ставим флаг для отображения выпадающего списка
                 */
                $loc2 = 1;
            }
            
            /**
             * Если дисциплина была выбрана ранее из списка,
             * пытаемся получить лекции
             */
            if ($_POST['discipline'] != -1 && $_POST['discipline'] != -2)
            {
                $data3 = Lecturers::model()->searchByFlag($_POST['discipline'], 0, $_POST['uplevel_id']);
                
                $lect1 = '<option value="">select lecturer</option>';
                /**
                 * Формируем массив для выпадающего списка лекций
                 */
                $data3 = CHtml::listData($data3, 'id', 'name');
                /**
                 * Формируем спсок опшинов для лекций
                 */
                foreach ($data3 as $value => $subcategory)
                {
                    $lect1 .= CHtml::tag('option', array('value' => $value), CHtml::encode($subcategory), true);
                }
            }
            /**
             * Возвращаем массив json
             */
            echo CJSON::encode(array(
                'loc1' => $loc1,
                'loc2' => $loc2,
                'lect1' => $lect1
            ));
            
    }
    
    public function actionGetCities()
    {
         $lect1 = NULL;
         
            /**
             * Если выбрана локация пытаемся вернуть данные в следующий выпадающий список
             */
            $loc1 = '<option value="">select an option</option>';
            /**
             * Это мы получаем город
             */
            $data1 = Cities::model()->findAll(array(
                        'condition' => 'region_id=:region_id',
                        'params' => array(':region_id' => $_POST['region_id'],),
                        'order' => 'city ASC'
                         )
                    );
            /**
             * Формируем массив для выпадающего списка
             */
            $data1 = CHtml::listData($data1, 'id', 'city');
            
            if ($data1)
            {
                /**
                 * Если запрос вернул дочерние элементы локации, 
                 * формируем список опшинов
                 */
                foreach ($data1 as $value => $subcategory)
                {
                    $loc1 .=CHtml::tag('option', array('value' => $value), CHtml::encode($subcategory), true);
                }
                /**
                 * Ставим флаг для отображения выпадающего списка
                 */
                $loc2 = 1;
            }
            
            /**
             * Если дисциплина была выбрана ранее из списка,
             * пытаемся получить лекции
             */
            if ($_POST['discipline'] != -1 && $_POST['discipline'] != -2)
            {
                $data3 = Lecturers::model()->searchByFlag($_POST['discipline'], 0, $_POST['uplevel_id']);
                
                $lect1 = '<option value="">select lecturer</option>';
                /**
                 * Формируем массив для выпадающего списка лекций
                 */
                $data3 = CHtml::listData($data3, 'id', 'name');
                /**
                 * Формируем спсок опшинов для лекций
                 */
                foreach ($data3 as $value => $subcategory)
                {
                    $lect1 .= CHtml::tag('option', array('value' => $value), CHtml::encode($subcategory), true);
                }
            }
            /**
             * Возвращаем массив json
             */
            echo CJSON::encode(array(
                'loc1' => $loc1,
                'loc2' => $loc2,
                'lect1' => $lect1
            ));
            
    }
    
    public function actionGetUniversity()
    {
         $lect1 = NULL;
         $loc1 = NULL;
                /**
                 * Если запрос ничего не вернул пытаемся получить список университетов,
                 * Потому, что это город и по городу можно получить универы
                 */
                $unis = Universities::model()->findAll(array(
                                'condition' => 'location_id=:location_id',
                                'params' => array(':location_id' => $_POST['city_id'],),
                                'order' => 'title ASC',
                            )
                        );
                
                if($unis)
                {
                    /**
                     * Если универы есть, формируем массив для выпадающего списка
                     */
                    $unis = CHtml::listData($unis, 'id', 'title');
                    
                    /**
                     * Формируем список опшинов с универами
                     */
                    foreach ($unis as $value => $subcategory)
                    {
                        $loc1 .= CHtml::tag('option', array('value' => $value), CHtml::encode($subcategory), true);
                    }
                    /**
                     * Ставим флаг для отображения выпадающего списка
                     */
                    $loc2 = 1;
                }
                else
                {
                    /**
                     * Если универов нет, ставим флаг для скрытия выпадающего списка
                     */
                    $loc2 = 0;
                } 
                
                /**
                 * Если дисциплина была выбрана ранее из списка,
                 * пытаемся получить лекции
                 */
                if ($_POST['discipline'] != -1 && $_POST['discipline'] != -2)
                {
                    $data3 = Lecturers::model()->searchByFlag($_POST['discipline'], 0, $_POST['uplevel_id']);

                    $lect1 = '<option value="">select lecturer</option>';
                    /**
                     * Формируем массив для выпадающего списка лекций
                     */
                    $data3 = CHtml::listData($data3, 'id', 'name');
                    /**
                     * Формируем спсок опшинов для лекций
                     */
                    foreach ($data3 as $value => $subcategory)
                    {
                        $lect1 .= CHtml::tag('option', array('value' => $value), CHtml::encode($subcategory), true);
                    }
                }
                
                /**
                * Возвращаем массив json
                */
               echo CJSON::encode(array(
                   'loc1' => $loc1,
                   'loc2' => $loc2,
                   'lect1' => $lect1
               ));
    }

    /**
     * Аяксом отдаем страну, регион или город в зависимости от параметров 
     * из пост запроса
     * @param int $uplevel_id Это так обозначается id родительского элемента
     * Например для региона uplevel_id == parent_id
     */
    public function actionDynamiccat()
    {
         $lect1 = NULL;
         
        if ($_POST['uplevel_id'] != "-1" && $_POST['uplevel_id'] != "-2")
        {
            /**
             * Если выбрана локация пытаемся вернуть данные в следующий выпадающий список
             */
            $loc1 = '<option value="">select an option</option>';
            /**
             * Это мы получаем саму страну при выборе страны из списка.Зачем?
             */
            //$model = Locations::model()->findByPk($_POST['uplevel_id']);
            
            /**
             * Это мы получаем дочерний элемент регион или город
             */
            $data1 = Locations::model()->findAll(array(
                        'condition' => 'parent_id=:parent_id',
                        'params' => array(':parent_id' => $_POST['uplevel_id'],),
                        'order' => 'title ASC'
                         )
                    );
            /**
             * Интересно, что мы будем делать с data2 ???
             */
            $data2 = $data1;
            
            /**
             * Формируем массив для выпадающего списка
             */
            $data1 = CHtml::listData($data1, 'id', 'title');
            
            /**
             * Получаем объект модели Локаций
             */
            $location_model = new Locations();

            if ($data1)
            {
                /**
                 * Если запрос вернул дочерние элементы локации, 
                 * формируем список опшинов
                 */
                foreach ($data1 as $value => $subcategory)
                {
                    $loc1 .=CHtml::tag('option', array('value' => $value), CHtml::encode($subcategory), true);
                }
                /**
                 * Ставим флаг для отображения выпадающего списка
                 */
                $loc2 = 1;
            }
            else
            {
                /**
                 * Если запрос ничего не вернул пытаемся получить список университетов,
                 * Потому, что это город и по городу можно получить универы
                 */
                $unis = Universities::model()->findAll(array(
                                'condition' => 'location_id=:location_id',
                                'params' => array(':location_id' => $_POST['uplevel_id'],),
                                'order' => 'title ASC',
                            )
                        );
                
                if($unis)
                {
                    /**
                     * Если универы есть, формируем массив для выпадающего списка
                     */
                    $unis = CHtml::listData($unis, 'id', 'title');
                    
                    /**
                     * Формируем список опшинов с универами
                     */
                    foreach ($unis as $value => $subcategory)
                    {
                        $loc1 .= CHtml::tag('option', array('value' => $value), CHtml::encode($subcategory), true);
                    }
                    /**
                     * Ставим флаг для отображения выпадающего списка
                     */
                    $loc2 = 1;
                }
                else
                {
                    /**
                     * Если универов нет, ставим флаг для скрытия выпадающего списка
                     */
                    $loc2 = 0;
                }  
            }
            
            /**
             * Если дисциплина была выбрана ранее из списка,
             * пытаемся получить лекции
             */
            if ($_POST['discipline'] != -1 && $_POST['discipline'] != -2)
            {
                $data3 = Lecturers::model()->searchByFlag($_POST['discipline'], $model->type_id, $_POST['uplevel_id']);
            }
        }
        else
        {
            /**
             * Если локация не определена, ставим флаг - скрыват следующий выпадающий список
             */
            $loc2 = 0;
            
            /**
             * Если дисциплина была выбрана ранее из списка,
             * пытаемся получить лекции
             */
            if ($_POST['discipline'] != -1 && $_POST['discipline'] != -2)
            {
                $data3 = Lecturers::model()->searchByFlag($_POST['discipline'], $_POST['downlevel'], $_POST['downlevel_id']);
            }
        }
        
        /**
         * Если Была выбрана дисциплина
         */
        if ($_POST['discipline'] != -1 && $_POST['discipline'] != -2)
        {
            $lect1 = '<option value="">select lecturer</option>';
            /**
             * Формируем массив для выпадающего списка лекций
             */
            $data3 = CHtml::listData($data3, 'id', 'name');
            /**
             * Формируем спсок опшинов для лекций
             */
            foreach ($data3 as $value => $subcategory)
            {
                $lect1 .= CHtml::tag('option', array('value' => $value), CHtml::encode($subcategory), true);
            }
        }
        /**
         * Возвращаем массив json
         */
        echo CJSON::encode(array(
            'loc1' => $loc1,
            'loc2' => $loc2,
            'lect1' => $lect1
        ));
    }

    public function actionDynamicuniver()
    {
         $lect1 = NULL;
         
        if ($_POST['discipline'] != -1 && $_POST['discipline'] != -2)
        {
            $lect1 = '<option value="">select lecturer</option>';

            if ($_POST['uni'] != -1 && $_POST['uni'] != -2)
                $data2 = Lecturers::model()->searchByFlag($_POST['discipline'], 10, $_POST['uni']);
            else
                $data2 = Lecturers::model()->searchByFlag($_POST['discipline'], 4, $_POST['city']);

            $data2 = CHtml::listData($data2, 'id', 'name');
            foreach ($data2 as $value => $subcategory)
            {
                $lect1 = $lect1 . CHtml::tag('option', array('value' => $value), CHtml::encode($subcategory), true);
            }
        }

        echo CJSON::encode(array(
            'lect1' => $lect1
        ));
    }
    
    /**
     * Загрузка списков аяксом при выбраном переключателе 
     * Флаг документа - сопровождающий лекцию или нет(университетский/нет)
     */
    public function actionDynamicuniflag()
    {
        $lect1 = null;
        
        $loc1 = '<option value="">select...</option>';
        if ($_POST['uni_flag'] == 1)
        {
            $data1 = Countries::model()->findAll(array(
                        'order' => 'country ASC'
                    ));
            $data1 = CHtml::listData($data1, 'id', 'country');
            foreach ($data1 as $value => $subcategory)
            {
                $loc1 .= CHtml::tag('option', array('value' => $value), CHtml::encode($subcategory), true);
            }
        }

        if ($_POST['discipline'] != -1 && $_POST['discipline'] != -2)
        {
            $lect1 = '<option value="">select lecturer</option>';

            $data2 = Lecturers::model()->searchByFlag($_POST['discipline'], 0, $_POST['uni_flag']);
            $data2 = CHtml::listData($data2, 'id', 'name');

            foreach ($data2 as $value => $subcategory)
            {
                $lect1 .= CHtml::tag('option', array('value' => $value), CHtml::encode($subcategory), true);
            }
        }

        echo CJSON::encode(array(
            'loc1' => $loc1,
            'loc2' => $_POST['uni_flag'],
            'lect1' => $lect1
        ));
    }
    
    /**
     * Получить список леций исходя из параметров пост
     */
    public function actionDynamiclecturer()
    {
        $lect1 = NULL;
        /**
         * Если дисциплина определена
         */
        if ($_POST['discipline'] != -1 && $_POST['discipline'] != -2)
        {
            if($_POST['uni_flag']!=-2)
            {
                /**
                * Создаем пустой опшин выбора лекции и обзовем его lect1
                */
               $lect1 = '<option value="">select lecturer</option>';

               /**
                * Если универ определен
                */
               if ($_POST['uni'] != -1 && $_POST['uni'] != -2)
               {
                   /**
                    * тип локации записываем 10, то есть для универа
                    */
                   $loc_type = 10;

                   /**
                    * А это id размещения - город, регион, страна
                    */
                   $loc_id = $_POST['uni'];
               }
               else if ($_POST['city'] != -1 && $_POST['city'] != -2)
               {
                   /**
                    * Если определен город тип локации = 4 для выборки с городом
                    */
                   $loc_type = 4;
                   /**
                    * иденитфиктор города
                    */
                   $loc_id = $_POST['city'];
               }
               else if ($_POST['country'] != -1 && $_POST['country'] != -2)
               {
                   /**
                    * Если определена страна ставим тип локации для выборки со страной
                    */
                   $loc_type = 2;
                   /**
                    * Идентификатор страны
                    */
                   $loc_id = $_POST['country'];
               }
               else
               {
                   /**
                    * Если ничего не определено, ставил тип локации 0, для выборки с документом
                    */
                   $loc_type = 0;
                   $loc_id = $_POST['uni_flag'];
               }

               //var_dump($_POST[discipline], $loc_type, $loc_id);exit;
               /**
                * Пробуем получить лекции. Дополнительные параметры служат 
                * для жадной загрузки вместе с универами странами , городами , дисциплинами и документами
                */
               $data1 = Lecturers::model()->searchByFlag($_POST['discipline'], $loc_type, $loc_id);
               //echo CVarDumper::dump($data1, 100, TRUE);exit;
               /**
                * Формируем массив для выпадающего списка
                */
               $data2 = CHtml::listData($data1, 'id', 'name');

               /**
                * Формируем массив опшинов
                */
               foreach ($data2 as $value => $subcategory)
               {
                   /**
                    * Заполняем переменную lect1 тегами опшин
                    */
                   $lect1 .= CHtml::tag('option', array('value' => $value), CHtml::encode($subcategory), true);
               }
               /**
                * Ставим флаг для открытия выпадающего списка лекций
                */
               $lect2 = 1;
            }
            else
            {
                /**
                * если флаг не определен, то не выводим выпадающий список
                */
                $lect2 = 0;
            }
            
            
        }
        else
        {
            /**
             * Снимаем флаг для открытия выпадающего списка лекций
             */
             $lect2 = 0;
        }
           
        echo CJSON::encode(array(
            'lect1' => $lect1,
            'lect2' => $lect2,
        ));
    }
    /**
     * Обработчик тыканья по выпадающему списку лекций
     * Если лекция выбрана, то поле ввода блокируем
     */
    public function actionDynamiclecturer2()
    {
        if ($_POST['lecturer'] != '')
            $lect = 1;
        else
            $lect = 0;
        echo CJSON::encode(array(
            'lect' => $lect,
        ));
    }
    
    /**
     * Обработчик ввода символов в поле ввода названия лекции
     * Блкирует выпадающий список
     */
    public function actionDynamiclecturer_new()
    {
        if ($_POST['lecturer'] != '')
            $lect = 1;
        else
            $lect = 0;
        echo CJSON::encode(array(
            'lect' => $lect,
        ));
    }

}
