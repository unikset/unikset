<?php
/**
 * Description of IndexController
 * Создание индекса документов
 *
 * @author admin
 */
class IndexController extends DashController
{
    public $defaultAction = 'create';
    
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
                'actions' => array('create'),
                'roles' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
    public function actionCreate()
    {
        /**
         * Импорт библтотеки Lucene
         */
        Yii::import('application.vendors.*');
        require_once('Zend/Search/Lucene.php');
        
        
        setlocale(LC_CTYPE, 'ru_RU.UTF-8');
        
        Zend_Search_Lucene_Analysis_Analyzer::setDefault(new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8());       
        
        /**
         * Объект Search Lucene
         */
        $index = new Zend_Search_Lucene(Yii::getPathOfAlias('application.runtime.search'), true);
        
        /**
         * Получаем все документы вместе с записями из таблиц document_tags и tags
         */
        $criteria = new CDbCriteria();
        //$criteria->compare('status', 2);
        $criteria->with = 'documentTags';
        $criteria->with = 'documentTags.document';
        //$criteria->group = 't.id';
        //$tags = Documents::model()->findAll($criteria);
        $tags = Tags::model()->findAll($criteria);
         
        //echo CVarDumper::dump($tags, 10, true);exit;
        
        /**
         * Перебираем записи
         */

        foreach($tags as $tag)
        {           
            $doc = new Zend_Search_Lucene_Document();
            //добавляем в индекс название документа
            $doc->addField(Zend_Search_Lucene_Field::Text('tag',CHtml::encode($tag->title), 'UTF-8'));
            
            foreach ($tag->documentTags as $dt)
            {
                //Добавляем в индекс ссылку на документ
                $doc->addField(Zend_Search_Lucene_Field::Text('doc_id', $dt->document_id, 'UTF-8'));   
            }
            


            $index->addDocument($doc);

        }

        $index->optimize();
        $index->commit();
        echo 'Lucene index создан успешно';
    }
}

