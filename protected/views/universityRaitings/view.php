<?php
$this->breadcrumbs=array(
	'University Raitings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UniversityRaitings', 'url'=>array('index')),
	array('label'=>'Create UniversityRaitings', 'url'=>array('create')),
	array('label'=>'Update UniversityRaitings', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UniversityRaitings', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UniversityRaitings', 'url'=>array('admin')),
);
?>

<h1>View UniversityRaitings #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'raiting_id',
		'university_id',
	),
)); ?>
