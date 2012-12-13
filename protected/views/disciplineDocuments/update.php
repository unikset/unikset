<?php
$this->breadcrumbs=array(
	'Discipline Documents'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DisciplineDocuments', 'url'=>array('index')),
	array('label'=>'Create DisciplineDocuments', 'url'=>array('create')),
	array('label'=>'View DisciplineDocuments', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DisciplineDocuments', 'url'=>array('admin')),
);
?>

<h1>Update DisciplineDocuments <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>