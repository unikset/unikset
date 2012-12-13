<?php
$this->breadcrumbs=array(
	'Document Raitings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DocumentRaitings', 'url'=>array('index')),
	array('label'=>'Manage DocumentRaitings', 'url'=>array('admin')),
);
?>

<h1>Create DocumentRaitings</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>