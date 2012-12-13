<?php
$this->breadcrumbs=array(
	'Document Lecturers',
);

$this->menu=array(
	array('label'=>'Create DocumentLecturers', 'url'=>array('create')),
	array('label'=>'Manage DocumentLecturers', 'url'=>array('admin')),
);
?>

<h1>Document Lecturers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
