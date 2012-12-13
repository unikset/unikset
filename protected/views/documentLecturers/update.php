<?php
$this->breadcrumbs=array(
	'Document Lecturers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DocumentLecturers', 'url'=>array('index')),
	array('label'=>'Create DocumentLecturers', 'url'=>array('create')),
	array('label'=>'View DocumentLecturers', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DocumentLecturers', 'url'=>array('admin')),
);
?>

<h1>Update DocumentLecturers <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>