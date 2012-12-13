<?php
$this->breadcrumbs=array(
	'Location Types'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List LocationTypes', 'url'=>array('index')),
	array('label'=>'Create LocationTypes', 'url'=>array('create')),
	array('label'=>'View LocationTypes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage LocationTypes', 'url'=>array('admin')),
);
?>

<h1>Update LocationTypes <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>