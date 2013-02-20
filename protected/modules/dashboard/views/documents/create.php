<?php
$this->breadcrumbs=array(
	'Documents'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Documents', 'url'=>array('index')),
	array('label'=>'Manage Documents', 'url'=>array('admin')),
);
?>

<p class="lead well well-small">Create Documents</p>

<?php echo $this->renderPartial('_create', array('model'=>$model)); ?>