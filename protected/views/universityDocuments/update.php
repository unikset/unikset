<?php
$this->breadcrumbs=array(
	'University Documents'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UniversityDocuments', 'url'=>array('index')),
	array('label'=>'Create UniversityDocuments', 'url'=>array('create')),
	array('label'=>'View UniversityDocuments', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UniversityDocuments', 'url'=>array('admin')),
);
?>

<h1>Update UniversityDocuments <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>