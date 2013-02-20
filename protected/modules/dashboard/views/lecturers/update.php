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

<p class="lead well well-small">Update Lecturers <?php echo $model->id; ?></p>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'disciplines'=>$disciplines,)); ?>