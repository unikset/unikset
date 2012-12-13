<?php
$this->breadcrumbs=array(
	'Lecturers'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Lecturers', 'url'=>array('index')),
	array('label'=>'Create Lecturers', 'url'=>array('create')),
	array('label'=>'View Lecturers', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Lecturers', 'url'=>array('admin')),
);
?>

<h1>Update Lecturers <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>