<?php
$this->breadcrumbs=array(
	'University Comments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UniversityComments', 'url'=>array('index')),
	array('label'=>'Manage UniversityComments', 'url'=>array('admin')),
);
?>

<h1>Create UniversityComments</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>