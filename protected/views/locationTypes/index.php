<?php
$this->breadcrumbs=array(
	'Location Types',
);

$this->menu=array(
	array('label'=>'Create LocationTypes', 'url'=>array('create')),
	array('label'=>'Manage LocationTypes', 'url'=>array('admin')),
);
?>

<h1>Location Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
