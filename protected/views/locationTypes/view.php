<?php
$this->breadcrumbs=array(
	'Location Types'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List LocationTypes', 'url'=>array('index')),
	array('label'=>'Create LocationTypes', 'url'=>array('create')),
	array('label'=>'Update LocationTypes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete LocationTypes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage LocationTypes', 'url'=>array('admin')),
);
?>

<h1>View LocationTypes #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
	),
)); ?>
