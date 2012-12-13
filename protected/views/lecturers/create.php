<?php
$this->breadcrumbs=array(
	'Lecturers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Lecturers', 'url'=>array('index')),
	array('label'=>'Manage Lecturers', 'url'=>array('admin')),
);
?>

<h1>Create Lecturers</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>