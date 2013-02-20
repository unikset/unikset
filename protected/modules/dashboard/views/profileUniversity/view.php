<?php
$this->breadcrumbs=array(
	'Profile Universities'=>array('index'),
	$model->id_profile,
);

$this->menu=array(
	array('label'=>'List ProfileUniversity', 'url'=>array('index')),
	array('label'=>'Create ProfileUniversity', 'url'=>array('create')),
	array('label'=>'Update ProfileUniversity', 'url'=>array('update', 'id'=>$model->id_profile)),
	array('label'=>'Delete ProfileUniversity', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_profile),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProfileUniversity', 'url'=>array('admin')),
);
?>

<h1>View ProfileUniversity #<?php echo $model->id_profile; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_profile',
		'university_id',
		'address',
	),
)); ?>
