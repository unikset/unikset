<?php
$this->breadcrumbs=array(
	'Raitings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Raitings', 'url'=>array('index')),
	array('label'=>'Manage Raitings', 'url'=>array('admin')),
);
?>

<h1>Create Raitings</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>