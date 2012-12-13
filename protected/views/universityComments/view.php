<?php
$this->breadcrumbs=array(
	'University Comments'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UniversityComments', 'url'=>array('index')),
	array('label'=>'Create UniversityComments', 'url'=>array('create')),
	array('label'=>'Update UniversityComments', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UniversityComments', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UniversityComments', 'url'=>array('admin')),
);
?>

<h1>View UniversityComments #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'comment_id',
		'university_id',
	),
)); ?>
