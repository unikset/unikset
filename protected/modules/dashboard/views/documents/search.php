<?php
$this->breadcrumbs=array(
	'Documents',
);
?>

<h1>Documents</h1>

<?php //Форма поиска документа ?>
<div class="search-form">
    <?php echo $this->renderPartial('_search',array('doc'=>$doc,));?>
</div>

<?php
if (isset($_POST['Locations']) && $_POST[Locations][2][id]) 
{
    $country = $_POST[Locations][2][id];
}
else 
{
    $country = -1;
}
//echo CVarDumper::dump($country, 10, TRUE);

if (isset($_POST['Locations']) && $_POST[Locations][3][id]) 
{
    $region = $_POST[Locations][3][id];
}
else 
{
    $region = -1;
}
//echo CVarDumper::dump($country, 10, TRUE);

if (isset($_POST['Locations']) && $_POST[Locations][4][id]) 
{
    $city = $_POST[Locations][4][id];
}
else 
{
    $city = -1;
}
//echo CVarDumper::dump($city, 10, TRUE);

if (isset($_POST['Universities']) && $_POST['Universities']['id']) 
{
    $uni = $_POST[Universities][id];
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

$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$doc->search($country, $region, $city, $uni, $dis_id, $lec_id),
	'itemView'=>'_view',
)); 
?>
