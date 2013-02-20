<?php
$this->breadcrumbs=array(
	'Disciplines'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Discipline', 'url'=>array('index')),
	array('label'=>'Manage Discipline', 'url'=>array('admin')),
);
?>

<p class="lead well well-small">Create Discipline</p>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>