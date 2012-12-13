<?php
$this->breadcrumbs=array(
	'Disciplines'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Discipline', 'url'=>array('index')),
	array('label'=>'Create Discipline', 'url'=>array('create')),
	array('label'=>'Update Discipline', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Discipline', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Discipline', 'url'=>array('admin')),
);
?>

<h1>View Discipline #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
	),
)); ?>
