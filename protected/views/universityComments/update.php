<?php
$this->breadcrumbs=array(
	'University Comments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UniversityComments', 'url'=>array('index')),
	array('label'=>'Create UniversityComments', 'url'=>array('create')),
	array('label'=>'View UniversityComments', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UniversityComments', 'url'=>array('admin')),
);
?>

<h1>Update UniversityComments <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>