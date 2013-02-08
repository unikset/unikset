<?php
class GetRegionsController extends Controller
{
    public function actionIndex()
    {
        if(Yii::app()->request->isAjaxRequest)
        {
            $loc1 = Yii::t('app', 'No regions');
            $university = Yii::t('app', 'No university');
            
            /**
             * Импорт класса для обработки выборки и выстаривании в алфавитном порядке
             */
            Yii::import('application.api.*');
            
                
            /**
             * Это мы получаем регион
             */
            $regions = Regions::model()->findAll(array(
                        'condition' => 'country_id=:country_id',
                        'params' => array(':country_id' => $_POST['country_id'],),
                        'order' => 'region ASC'
                         )
                    );
            
            /**
             * Получаем все города из этой страны
             */
            $cities = Cities::model()->findAll(array(
                        'condition' => 'country_id=:country_id',
                        'params' => array(':country_id' => $_POST['country_id'],)
                         ));
            if($cities)
            {
                /**
                 * Создаем список id городов
                 */
                $data = CHtml::listData($cities, 'id','id');
                $list = implode(',', $data);
                /**
                 * Получаем универы которые есть в этой стране
                 */
                $univer = Universities::model()->findAll(array(
                            'condition' => 'location_id IN ('.$list.') order by title'
                         ));
            }
            

            if($univer)
            {
                $first_letter = "";
                $university = '<h2>Select a university</h2><br>';
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
                        $(".univer > a").click(function(event){
                            event.preventDefault();
                            var univer_id = $(this).attr("href");
                            var university = $(this).html();
                            $("#university_id").val(univer_id);
                            $("#del_univer").remove();
                            $(".string-history").append(" <span id=\"del_univer\">&rarr; "+university+"<span>");
                        });
                    </script>
                    ';
            }

            /**
             * Формируем массив для выпадающего списка
             */
            //$regions = CHtml::listData($regions, 'id', 'region');
            
            if ($regions)
            {
                /**
                * Экземпляр класса Stringi
                */
               $str = new Stringi('en');
                
               $loc1 = '';
                /**
                 * Заголовок блока
                 */                        
                $loc1 .= '<h2>Select a region <span class="region_btn btn btn-small">Back to country</span></h2><br>';
                /**
                 * Если запрос вернул дочерние элементы локации, 
                 * формируем список
                 */
                foreach ($str->alphaGroup($regions,'region') as $value => $subcategory)
                {
                    $loc1 .= "<strong class='letter'>{$value}</strong><br>";
                    foreach($subcategory as $region) 
                    {
                        $loc1 .= CHtml::link($region->region, $region->id, array('id'=>$region->id)).'<br>';
                    }
                    
                }
                $loc1 .= '<br><br>';
                $loc1 .= '
                    <script>
                        $(".locations > a").click(function(event){
                            event.preventDefault();
                            var id = $(this).attr("href");
                            var region = $(this).html();
                            $.post("/getCities", { region_id: id },
                              function(data){
                                  $(".string-history > #l-h").append("<span class=\"del_region\">&rarr; "+region+" <span id=\"del_region\">x</span></span>");
                                  //$("<span id=\"del_region\">&rarr; "+region+"</span>").appendTo("#del_country")
                                  $(".locations").replaceWith("<div class=\"locations locations51\">"+data.loc1+"</div>");
                                  $(".univer").replaceWith("<div class=\"univer\">"+data.univers+"</div>");
                                  $("#region_id").val(id);
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
            Yii::app()->end();
        }
    }
    
}