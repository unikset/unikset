<?php
$this->breadcrumbs=array(
	'Location Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List LocationTypes', 'url'=>array('index')),
	array('label'=>'Manage LocationTypes', 'url'=>array('admin')),
);
?>

<h1>Create LocationTypes</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>