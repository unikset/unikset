<?php
/**
 * Description of ParseController
 * Песочница парсинга документов
 * @author admin
 */
class ParseController extends Controller
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
                'actions' => array('index'),
                'users' => array('*'),
            ),
            
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
    public function actionIndex()
    {
        /**
         * Импортируем классы расширения парсера пдф документов
         */
        Yii::import('application.extensions.docparser.*');
        
        /**
         * Получаем имя файла(пока в ручную)
         */
        $filename = $_SERVER['DOCUMENT_ROOT'].'/files/notes1.pdf';
        
        //$content = file_get_contents($filename);
        //$f = fopen($filename, "r");
        //echo CVarDumper::dump($content, 10, TRUE);exit;
        /**
         * Получаем контент
         */
        $content = shell_exec('C:\\xpdf\\bin\\pdftotext '.$filename.' -');
        //$content = shell_exec('C:\\xpdf\\bin\\pdftotext '.$filename.' -');
        echo CVarDumper::dump($content, 10, TRUE);exit;
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

        echo 'Уникальные слова';
        echo CVarDumper::dump($uniques,10,TRUE);
        
        /**
         * Получаем массив слов и их вес слово=>вес
         */
        $wes = $wp->weights($uniques);
        echo 'Вес слова<br>';
        echo CVarDumper::dump($wes,10,TRUE);exit;
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
            //$criteria = new CDbCriteria();
            //$criteria->compare('title', $title);
            //$exist_tag = Tags::model()->findAll($criteria);
            //if($exist_tag)
            //{
                //Если тег существует, пропускаем итерацию
               // continue;
            //}
            //else
            //{
                /**
                 * Записываем тег в таблицу
                 */
                $tag = new Tags();
                $tag_doc = new DocumentTags();

                $tag->title = $title;
                if($tag->save())
                {
                    $tag_doc->document_id = 43;
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
            //}
            if(isset($errors))
            {
                echo CVarDumper::dump($errors, 10, TRUE);
                Yii::app()->end();
            }
        }

    }
    
    
}

