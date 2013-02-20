<?php
$this->breadcrumbs=array(
	'Profile Universities'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProfileUniversity', 'url'=>array('index')),
	array('label'=>'Manage ProfileUniversity', 'url'=>array('admin')),
);
?>

<h1>Create ProfileUniversity</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>