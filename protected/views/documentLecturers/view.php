<?php
$this->breadcrumbs=array(
	'Document Lecturers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DocumentLecturers', 'url'=>array('index')),
	array('label'=>'Create DocumentLecturers', 'url'=>array('create')),
	array('label'=>'Update DocumentLecturers', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DocumentLecturers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DocumentLecturers', 'url'=>array('admin')),
);
?>

<h1>View DocumentLecturers #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'document_id',
		'lecturer_id',
	),
)); ?>
