<?php
$this->breadcrumbs=array(
	'File Infoses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List FileInfos', 'url'=>array('index')),
	array('label'=>'Create FileInfos', 'url'=>array('create')),
	array('label'=>'Update FileInfos', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete FileInfos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FileInfos', 'url'=>array('admin')),
);
?>

<h1>View FileInfos #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'link',
	),
)); ?>
