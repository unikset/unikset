<?php
$this->breadcrumbs=array(
	'Disciplines'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Discipline', 'url'=>array('index')),
	array('label'=>'Create Discipline', 'url'=>array('create')),
	array('label'=>'View Discipline', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Discipline', 'url'=>array('admin')),
);
?>

<h1>Update Discipline <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>