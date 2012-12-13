<?php
$this->breadcrumbs=array(
	'University Raitings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UniversityRaitings', 'url'=>array('index')),
	array('label'=>'Manage UniversityRaitings', 'url'=>array('admin')),
);
?>

<h1>Create UniversityRaitings</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>