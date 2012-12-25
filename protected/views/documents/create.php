<?php
$this->breadcrumbs=array(
	'Documents'=>array('index'),
	'Create',
);

/*$this->menu=array(
	array('label'=>'List Documents', 'url'=>array('index')),
	array('label'=>'Manage Documents', 'url'=>array('admin')),
);*/
?>

<div class="pagetitle"><h1>Create Documents</h1></div>

<?php echo $this->renderPartial('_create', array('model'=>$model)); ?>