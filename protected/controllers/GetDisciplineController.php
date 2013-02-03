<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class GetDisciplineController extends Controller
{
    public function actionIndex()
    {
        if(!Yii::app()->request->isAjaxRequest)
        {
            return FALSE;
        }
        
        $dis = '';
        
        Yii::import('application.api.*');
        $str = new Stringi('en');
        $dis .= '<h2>'.Yii::t('app','Select a discipline').'</h2>';
        foreach($str->alphaGroup(Discipline::model()->findAll(),'title') as $k => $v) 
        {
                $dis .= "<strong class='letter'>$k</strong><br>";
                foreach($v as $discipline) 
                {
                        $dis .= '<a href="'.$discipline->id.'" id="'.$discipline->id.'">'.$discipline->title.'</a>&nbsp;';
                }
                $dis .= '<br><br>';
        }

        $dis .= '<script>
            $(".discipline > a").click(function(event){
                event.preventDefault();
                var discipline_id = $(this).attr("href");
                $("#discipline_id").val(discipline_id);
                var discipline = $(this).html();
                $.post("/getLecture", { discipline_id: discipline_id },
                  function(data){
                      $(".string-history > #d-h").append("<span class=\"del_discipline\">&rarr; "+discipline+" <span id=\"del_discipline\">x</span></span>");
                      $(".discipline").replaceWith("<div class=\"discipline\">"+data.lect+"</div>");
                  }, "json");
            });
        </script>';
        
        echo CJSON::encode(array(
                     'dis' => $dis,
                    ));
    }
}

