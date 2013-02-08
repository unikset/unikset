<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl. '/js/jquery-ui-1.8.16.custom.min.js', CClientScript::POS_HEAD);  
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl. '/js/filter.js', CClientScript::POS_HEAD); 
        
$this->breadcrumbs=array(
	Yii::t('app','Documents'),
);
?>

<div class="pagetitle">
    <div class="string-history">
        <span id="l-h"></span>
        <span id="d-h"></span>
    </div>
    <h1><?php echo Yii::t('app','Documents');?></h1>
    <div class="filter-menu">
        <a id="filter-link-1" href="javascript:toggleCountryFilter()" style="display: none;"><?php echo Yii::t('app','select country and university');?> ▼</a>
        <a id="filter-link-2" href="javascript:toggleLectureFilter()"><?php echo Yii::t('app','select discipline and lecture');?> ▼</a>
    </div>
    
    <div id="radio" class="group">
          <label class="label" for="ex07-1"><?php echo Yii::t('app','Universitys');?> <input type="radio" name="uni" id="uni" /></label>
          

          
          <label class="label" for="notuni"><input type="radio" name="uni" id="notuni" checked /><?php echo Yii::t('app','Not universitys');?></label>
  </div>
    
</div>
<div id="document-filter">
	<div id="document-filter-angle">
		<img src="<?php echo Yii::app()->request->baseUrl ?>/images/angle-top.png"/>
	</div>
    <!-- выпадающий блок  с дисциплинами и лекциями -->
        <div id="discipline-filter-wrapper">

        </div>
    <!-- блок с универами и локациями -->
	<div id="document-filter-wrapper">
            <div class="inner">
                
                
                <div class="locations locations100">
                   
                    <?php 
                    Yii::import('application.api.*');
                    $str = new Stringi('en');
                    echo '<h2>'.Yii::t('app','Select a country').'</h2>';
                    foreach($str->alphaGroup(Countries::model()->findAll(),'country') as $key => $val) 
                    {
                            echo "<strong class='letter'>{$key}</strong><br>";
                            foreach($val as $country) 
                            {
                                    echo '<a href="'.$country->id.'" id="'.$country->id.'">'.$country->country.'</a>&nbsp;';
                            }
                            echo '<br><br>';
                    }
                    ?>
                    <script>
                        $('.locations > a').click(function(event){
                            event.preventDefault();
                            var id = $(this).attr('href');
                            var country = $(this).html();
                            $.post("/getRegions", { country_id: id },
                              function(data){ 
                                  $('.string-history > #l-h').append("<span class='del_country'>"+country+"<span id='del_country'>x</span></span>");
                                  $('.locations').replaceWith('<div class="locations">'+data.loc1+'</div>');
                                  $('.locations').removeClass('locations100').addClass('locations51');
                                  $('.univer').replaceWith('<div class="univer">'+data.univers+'</div>');
                                  $('.univer').show();
                                  $('#country_id').val(id);
                              }, "json");
                        });
                    </script>
                    
                </div>
                
                <div class="univer" style="display: none;"></div>
            </div>
            
        </div>
</div>
<div id="discipline-filter">
	<div id="document-filter-angle">
		<img src="<?php echo Yii::app()->request->baseUrl ?>/images/angle-top.png"/>
	</div>
    <!-- выпадающий блок  с дисциплинами и лекциями -->
	<div id="document-filter-wrapper">
            <div class="inner">
                <div class="discipline">
                     <?php 
                    Yii::import('application.api.*');
                    $str = new Stringi('en');
                    echo '<h2>'.Yii::t('app','Select a discipline').'</h2>';
                    foreach($str->alphaGroup(Discipline::model()->findAll(),'title') as $k => $v) 
                    {
                            echo "<strong class='letter'>{$k}</strong><br>";
                            foreach($v as $discipline) 
                            {
                                    echo '<a href="'.$discipline->id.'" id="'.$discipline->id.'">'.$discipline->title.'</a>&nbsp;';
                            }
                            echo '<br><br>';
                    }
                    ?>
                    <script>
                        $('.discipline > a').click(function(event){
                            event.preventDefault();
                            var discipline_id = $(this).attr('href');
                            $('#discipline_id').val(discipline_id);
                            var discipline = $(this).html();
                            $.post("/getLecture", { discipline_id: discipline_id },
                              function(data){
                                  $(".string-history > #d-h").append('<span class="del_discipline">&rarr; '+discipline+' <span id="del_discipline">x</span></span>');
                                  $('.discipline').replaceWith('<div class="discipline">'+data.lect+'</div>');
                              }, "json");
                        });
                    </script>
                </div>
            </div>
            
        </div>
</div>


<div class="page-container">

    
<?php //Форма поиска документа ?>
<?php echo $this->renderPartial('_search',array('doc'=>$doc,));?>

<?php
//if (isset($_POST['Countries']) && $_POST['Countries']['id']) 
//{
//    $country = $_POST['Countries']['id'];
//}
//else 
//{
//    $country = -1;
//}
////echo CVarDumper::dump($country, 10, TRUE);
//
//if (isset($_POST['Regions']) && $_POST['Regions']['id']) 
//{
//    $region = $_POST['Regions']['id'];
//}
//else 
//{
//    $region = -1;
//}
////echo CVarDumper::dump($country, 10, TRUE);
//
//if (isset($_POST['Cities']) && $_POST['Cities']['id']) 
//{
//    $city = $_POST['Cities']['id'];
//}
//else 
//{
//    $city = -1;
//}
////echo CVarDumper::dump($city, 10, TRUE);
//
//if (isset($_POST['Universities']) && $_POST['Universities']['id']) 
//{
//    $uni = $_POST['Universities']['id'];
//}
//else 
//{
//    $uni = -1;
//}
////echo CVarDumper::dump($uni, 10, TRUE);
//
//if(isset($_POST['Discipline']) && $_POST['Discipline']['id'])
//{
//    $dis_id = $_POST['Discipline']['id'];
//}
//else
//{
//    $dis_id = -1;
//}
////echo CVarDumper::dump($dis_id, 10, TRUE);
//
//if(isset($_POST['Lecturers']) && $_POST['Lecturers']['id'])
//{
//    $lec_id = $_POST['Lecturers']['id'];
//}
//else
//{
//    $lec_id = -1;
//}
//echo CVarDumper::dump($lec_id, 10, TRUE);
if(isset($results))
{
    echo '<h1>'.Yii::t('app','Search results').'</h1>';
    //echo CVarDumper::dump($results, 10, TRUE);
    $this->renderPartial('_search_result', array('results'=>$results));
}
else
{

//    $this->widget('zii.widgets.CListView', array(
//            'dataProvider'=>$doc->search($country, $region, $city, $uni, $dis_id, $lec_id),
//            'itemView'=>'_view',
//    )); 
    echo '<h2>No results</h2>';

}


?>

</div>