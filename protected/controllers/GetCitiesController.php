<?php
class GetCitiesController extends Controller
{
    public function actionIndex()
    {
        if(Yii::app()->request->isAjaxRequest)
        {
            
            $loc1 = '';
            /**
             * Это мы получаем город
             */
            $cities = Cities::model()->findAll(array(
                        'condition' => 'region_id=:region_id',
                        'params' => array(':region_id' => $_POST['region_id'],),
                        'order' => 'city ASC'
                         )
                    );
            
            /**
             * Создаем список id городов
             */
            $data = CHtml::listData($cities, 'id','id');
            $list = implode(',', $data);
            
            
            /**
             * Формируем массив для выпадающего списка
             */
            $cities = CHtml::listData($cities, 'id', 'city');
            
            
            /**
             * Получаем универы которые есть в этой стране
             */
            $univer = Universities::model()->findAll(array(
                        'condition' => 'location_id IN ('.$list.') order by title'
                     ));

            if($univer)
            {
                $first_letter = "";
                $university .= '<h2>Select a university</h2><br>';
                foreach ($univer as $res)
                {  
                    //Если первая буква строки не равна букве которая записана в переменную $first_letter
                    if(mb_substr($res->title, 0, 1, 'utf-8') != $first_letter)
                    {       
                        //Записываем первую букву в переменную $first_letter  и приводим в верхний регистр
                        $first_letter = mb_strtoupper(mb_substr($res->title, 0, 1, 'utf-8'),'utf-8');
                        $university .= "<strong class='letter'>{$first_letter}</strong><br>";
                    }

                    $university .= CHtml::link($res->title, $res->id, array('id'=>'u-'.$u->id)).'<br>';   
                }
                $university .= '<br><br>';
                $university .= '
                    <script>
                        $(".univer > a").click(function(event){
                            event.preventDefault();
                            var univer_id = $(this).attr("href");
                            var university = $(this).html();
                            $("#university_id").val(univer_id);
                            $("#del_univer").remove();
                            $(".string-history").append("<span class=\"del_univer\">&rarr; "+university+" <span id=\"del_univer\">x</span></span>");
                        });
                    </script>
                    ';
            }
            
            
            if ($cities)
            {
                /**
                 * Если запрос вернул дочерние элементы локации, 
                 * формируем список опшинов
                 */
                $first_letter = "";
                $loc1 .= '<h2>Select a city</h2><br>';
                foreach ($cities as $value => $subcategory)
                {  
                    //Если первая буква строки не равна букве которая записана в переменную $first_letter
                    if(mb_substr($subcategory, 0, 1, 'utf-8') != $first_letter)
                    {       
                        //Записываем первую букву в переменную $first_letter  и приводим в верхний регистр
                        $first_letter = mb_strtoupper(mb_substr($subcategory, 0, 1, 'utf-8'),'utf-8');
                        $loc1 .= "<strong class='letter'>{$first_letter}</strong><br>";
                    }

                    $loc1 .= CHtml::link($subcategory, $value, array('id'=>'u-'.$value)).'<br>';   
                }
                $loc1 .= '<br><br>';
//                foreach ($cities as $value => $subcategory)
//                {
//                    $loc1 .= CHtml::link($subcategory, $value, array('id'=>$value));
//                }
                $loc1 .= '
                    <script>
                        $(".locations > a").click(function(event){
                            event.preventDefault();
                            var id = $(this).attr("href");
                            var city = $(this).html();
                            $.post("/getUniver", { city_id: id },
                              function(data){
                                  $(".string-history > #l-h").append("<span class=\"del_city\">&rarr; "+city+" <span id=\"del_city\">x</span></span>");
                                  $(".univer").replaceWith("<div class=\"univer100\">"+data.univers+"</div>");
                                  $("#city_id").val(id);
                                  $(".locations").hide();
                              }, "json");
                        });
                    </script>
                    ';
            }
            /**
             * Возвращаем массив json
             */
            echo CJSON::encode(array(
                'loc1' => $loc1,
                'univers'=>$university,
            ));
        }
        else
        {
            return FALSE;
        }
    }
}
