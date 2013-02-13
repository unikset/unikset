<?php
/**
 * Description of GetCountryController
 *
 * @author admin
 */
class GetCountryController extends Controller
{
    public function actionIndex()
    {
        if(!Yii::app()->request->isAjaxRequest)
        {
            return FALSE;
        }
        $loc1 = '';
        Yii::import('application.api.*');
        $str = new Stringi('en');
        $loc1 .= '<h2>'.Yii::t('app','Select a country').'</h2>';
        foreach($str->alphaGroup(Countries::model()->findAll(),'country') as $key => $val) 
        {
                $loc1 .= "<strong class='letter'>$key</strong><br>";
                foreach($val as $country) 
                {
                        $loc1 .= '<a href="'.$country->id.'" id="'.$country->id.'">'.$country->country.'</a>&nbsp;';
                }
                $loc1 .= '<br><br>';
        }

          $loc1 .=  '<script>
                $(".locations > a").click(function(event){
                    event.preventDefault();
                    var id = $(this).attr("href");
                    var country = $(this).html();
                    $.post("'.Yii::app()->params['subdir'].'/getRegions", { country_id: id },
                      function(data){ 
                          $(".string-history > #l-h").append("<span class=\"del_country\">"+country+" <span id=\"del_country\">x</span></span>");
                          $(".locations").replaceWith("<div class=\"locations\">"+data.loc1+"</div>");
                          $(".locations").removeClass("locations100").addClass("locations51");
                          $(".univer").replaceWith("<div class=\"univer\">"+data.univers+"</div>");
                          $(".univer").show();
                          $("#country_id").val(id);
                      }, "json");
                });
            </script>';

            /**
             * Возвращаем массив json
             */
            echo CJSON::encode(array(
                'loc1' => $loc1,
            ));
    }
                    
}

