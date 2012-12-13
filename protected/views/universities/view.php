<?php
$this->breadcrumbs=array(
	'Universities'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Universities', 'url'=>array('index')),
	array('label'=>'Create Universities', 'url'=>array('create')),
	array('label'=>'Update Universities', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Universities', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Universities', 'url'=>array('admin')),
);
?>

<h1>View Universities #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'title_short',
		'description',
		'location_id',
	),
)); ?>
