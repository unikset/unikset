<?php
$this->breadcrumbs=array(
	'University Raitings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UniversityRaitings', 'url'=>array('index')),
	array('label'=>'Create UniversityRaitings', 'url'=>array('create')),
	array('label'=>'View UniversityRaitings', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UniversityRaitings', 'url'=>array('admin')),
);
?>

<h1>Update UniversityRaitings <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>