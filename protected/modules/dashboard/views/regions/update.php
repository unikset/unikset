<?php
$this->breadcrumbs=array(
	'Regions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Regions', 'url'=>array('index')),
	array('label'=>'Create Regions', 'url'=>array('create')),
	array('label'=>'View Regions', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Regions', 'url'=>array('admin')),
);
?>

<h1>Update Regions <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>