<?php
$this->breadcrumbs=array(
	'Documents',
);
?>

<div class="pagetitle"><h1>Documents1</h1><div class="filter-menu"><a id="filter-link-1" href="javascript:toggleCountryFilter()">select country and university ▼</a><a id="filter-link-2" href="javascript:toggleLectureFilter()">select discipline and lecture ▼</a></div></div>
<div id="document-filter">
	<div id="document-filter-angle">
		<img src="<?php echo Yii::app()->request->baseUrl ?>/images/angle-top.png"/>
	</div>
	<div id="document-filter-wrapper">
	</div>
</div>
<div class="page-container">
<?php //Форма поиска документа ?>
<!--<div class="search-form"><?php echo $this->renderPartial('_search',array('doc'=>$doc,));?></div>-->
<?php
if (isset($_POST['Countries']) && $_POST['Countries']['id']) 
{
    $country = $_POST['Countries']['id'];
}
else 
{
    $country = -1;
}
//echo CVarDumper::dump($country, 10, TRUE);

if (isset($_POST['Regions']) && $_POST['Regions']['id']) 
{
    $region = $_POST['Regions']['id'];
}
else 
{
    $region = -1;
}
//echo CVarDumper::dump($country, 10, TRUE);

if (isset($_POST['Cities']) && $_POST['Cities']['id']) 
{
    $city = $_POST['Cities']['id'];
}
else 
{
    $city = -1;
}
//echo CVarDumper::dump($city, 10, TRUE);

if (isset($_POST['Universities']) && $_POST['Universities']['id']) 
{
    $uni = $_POST['Universities']['id'];
}
else 
{
    $uni = -1;
}
//echo CVarDumper::dump($uni, 10, TRUE);

if(isset($_POST['Discipline']) && $_POST['Discipline']['id'])
{
    $dis_id = $_POST['Discipline']['id'];
}
else
{
    $dis_id = -1;
}
//echo CVarDumper::dump($dis_id, 10, TRUE);

if(isset($_POST['Lecturers']) && $_POST['Lecturers']['id'])
{
    $lec_id = $_POST['Lecturers']['id'];
}
else
{
    $lec_id = -1;
}
//echo CVarDumper::dump($lec_id, 10, TRUE);
if(isset($results))
{
    echo '<h1>Search results</h1>';
    //echo CVarDumper::dump($results, 10, TRUE);
    $this->renderPartial('_search_result', array('results'=>$results));
}
else
{

    $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$doc->search($country, $region, $city, $uni, $dis_id, $lec_id),
            'itemView'=>'_view',
    )); 

}


?>

</div>