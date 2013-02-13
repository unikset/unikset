<?php
/**
 * Description of GetLectureController
 * Получить лекции если пришел аякс запрос
 * @author admin
 */
class GetLectureController extends Controller
{
    public function actionIndex()
    {
        if(Yii::app()->request->isAjaxRequest)
        {
            $lect1 = '';
               /**
                * Пробуем получить лекции. Дополнительные параметры служат 
                * для жадной загрузки вместе с универами странами , городами , дисциплинами и документами
                */
               $data1 = Lecturers::model()->searchByDiscipline($_POST['discipline_id']);
               if($data1)
               {
                   //echo CVarDumper::dump($data1, 100, TRUE);exit;
                    /**
                     * Формируем массив для выпадающего списка
                     */
                    $data2 = CHtml::listData($data1, 'id', 'name');
                    
                    $lect1 .= '<h2>Select a lecture </h2><br><span class="lecture_btn">&larr; Back to disciplines</span><br>';
                    $first_letter='';
                    /**
                     * Формируем массив опшинов
                     */
                    foreach ($data2 as $value => $subcategory)
                    {
                        //Если первая буква строки не равна букве которая записана в переменную $first_letter
                        if(mb_substr($subcategory, 0, 1, 'utf-8') != $first_letter)
                        {       
                            //Записываем первую букву в переменную $first_letter  и приводим в верхний регистр
                            $first_letter = mb_strtoupper(mb_substr($subcategory, 0, 1, 'utf-8'),'utf-8');
                            $lect1 .= "<strong class='letter'>{$first_letter}</strong><br>";
                        }
                        /**
                         * Заполняем переменную lect1 тегами опшин
                         */
                        $lect1 .= CHtml::link($subcategory, $value, array('l-id' => $value));
                    }
                    
                    $lect1 .= '<script>
                        $(".discipline > a").click(function(event){
                            event.preventDefault();
                            var lect_id = $(this).attr("href");
                            var lecture = $(this).html();
                            $("#lecture_id").val(lect_id);
                            $(".del_lecture").remove();
                            $(".string-history > #d-h").append("<sapn class=\"del_lecture\">&rarr; "+lecture+" <span id=\"del_lecture\">x</span></span>");
                            toggleLectureFilter();
                        });
                    </script>';
                    
                    echo CJSON::encode(array(
                     'lect' => $lect1,
                    ));
               }
               else
               {
                   echo CJSON::encode(array(
                     'lect' => 'No lecturers',
                    ));
                    Yii::app()->end();
               }
               
        }
        else
        {
            return FALSE;
        }
    }
}

