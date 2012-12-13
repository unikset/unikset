<?php
$this->breadcrumbs=array(
	'Lecturers',
);

$this->menu=array(
	array('label'=>'Create Lecturers', 'url'=>array('create')),
	array('label'=>'Manage Lecturers', 'url'=>array('admin')),
);
?>

<h1>Lecturers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
