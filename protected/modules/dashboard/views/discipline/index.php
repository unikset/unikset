<?php
$this->breadcrumbs=array(
	'Disciplines',
);

$this->menu=array(
	array('label'=>'Create Discipline', 'url'=>array('create')),
	array('label'=>'Manage Discipline', 'url'=>array('admin')),
);
?>

<h1>Disciplines</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
