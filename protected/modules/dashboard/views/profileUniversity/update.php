<?php
$this->breadcrumbs=array(
	'Profile Universities'=>array('index'),
	$model->id_profile=>array('view','id'=>$model->id_profile),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProfileUniversity', 'url'=>array('index')),
	array('label'=>'Create ProfileUniversity', 'url'=>array('create')),
	array('label'=>'View ProfileUniversity', 'url'=>array('view', 'id'=>$model->id_profile)),
	array('label'=>'Manage ProfileUniversity', 'url'=>array('admin')),
);
?>

<h1>Update ProfileUniversity <?php echo $model->id_profile; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>