<?php
$this->breadcrumbs=array(
	'University Comments',
);

$this->menu=array(
	array('label'=>'Create UniversityComments', 'url'=>array('create')),
	array('label'=>'Manage UniversityComments', 'url'=>array('admin')),
);
?>

<h1>University Comments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
