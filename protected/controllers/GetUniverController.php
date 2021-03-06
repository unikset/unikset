<?php
class GetUniverController extends Controller
{
    public function actionIndex()
    {
        if(Yii::app()->request->isAjaxRequest)
        {   
            $university = '';
            /**
             * Получаем универы которые есть в этой стране
             */
            $univer = Universities::model()->findAll(array(
                        'condition' => 'location_id = '.$_POST['city_id'].' order by title'
                     ));

            if($univer)
            {
                $first_letter = "";
                $university .= '<h2>Select a university </h2><br><span class="univer_btn">&larr; Back to cities</span><br>';
                foreach ($univer as $res)
                {  
                    //Если первая буква строки не равна букве которая записана в переменную $first_letter
                    if(mb_substr($res->title, 0, 1, 'utf-8') != $first_letter)
                    {       
                        //Записываем первую букву в переменную $first_letter  и приводим в верхний регистр
                        $first_letter = mb_strtoupper(mb_substr($res->title, 0, 1, 'utf-8'),'utf-8');
                        $university .= "<strong class='letter'>{$first_letter}</strong><br>";
                    }

                    $university .= CHtml::link($res->title, $res->id, array('id'=>'u-'.$res->id)).'<br>';   
                }
                $university .= '<br><br>';
                $university .= '
                    <script>
                        $(".univer100 > a").click(function(event){
                            event.preventDefault();
                            var univer_id = $(this).attr("href");
                            var university = $(this).html();
                            $("#university_id").val(univer_id);
                            $(".del_univer").remove();
                            $(".string-history > #l-h").append("<sapn class=\"del_univer\">&rarr; "+university+" <span id=\"del_univer\">x</span></span>");
                            toggleCountryFilter();
                        });
                    </script>
                    ';
            }
            
            

            /**
             * Возвращаем массив json
             */
            echo CJSON::encode(array(
                //'loc1' => $loc1,
                'univers'=>$university,
            ));
        }
        else
        {
            return FALSE;
        }
    }
}

