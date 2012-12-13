<?php
$this->breadcrumbs=array(
	'Raitings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Raitings', 'url'=>array('index')),
	array('label'=>'Create Raitings', 'url'=>array('create')),
	array('label'=>'View Raitings', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Raitings', 'url'=>array('admin')),
);
?>

<h1>Update Raitings <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>