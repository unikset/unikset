<?php
$this->breadcrumbs=array(
	'Raitings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Raitings', 'url'=>array('index')),
	array('label'=>'Create Raitings', 'url'=>array('create')),
	array('label'=>'Update Raitings', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Raitings', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Raitings', 'url'=>array('admin')),
);
?>

<h1>View Raitings #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'raiting_value',
		'insert_date',
		'author_ip',
	),
)); ?>
