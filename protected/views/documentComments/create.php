<?php
$this->breadcrumbs=array(
	'Document Comments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DocumentComments', 'url'=>array('index')),
	array('label'=>'Manage DocumentComments', 'url'=>array('admin')),
);
?>

<h1>Create DocumentComments</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>