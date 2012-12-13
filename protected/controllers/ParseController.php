<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ParseController
 *
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
        Yii::import('application.extensions.docparser.*');
        
        $filename = $_SERVER['DOCUMENT_ROOT'].'/files/notes1.pdf';
        
        $content = shell_exec('C:\\xpdf\\bin\\pdftotext '.$filename.' -');
	//echo $content;
        $content = mb_convert_encoding($content,'UTF-8');

    
        $wp = new Text_WordsParser(array('Latin', 'Cyrillic'));
    
        $html = $content;
        $text = $wp->parse($html, $words, $sentences, $uniques, $offset_map);

        echo 'Уникальные слова';
        echo CVarDumper::dump($uniques,10,TRUE);
        
        $wes = $wp->weights($uniques);
        
        foreach ($wes as $k => $v)
        {
            if(is_numeric($k))
            {
                unset($wes[$k]);
            }
            if(strlen($k)<3)
            {
                unset($wes[$k]);
            }
        }
        $i=0;
        foreach ($wes as $title => $weight)
        {
            $criteria = new CDbCriteria();
            $criteria->compare('title', $title);
            $exist_tag = Tags::model()->findAll($criteria);
            if($exist_tag)
            {
                //echo 'Тег существует';exit;
                continue;
            }
            else
            {
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
                        $errors[]='Error - '.$i++;
                    }
                }
                else
                {
                    $errors[] = 'Error tag = '.$i;
                }
            }
            
        }

    }
    
    
}

