<?php
$this->breadcrumbs=array(
	'Discipline Documents'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DisciplineDocuments', 'url'=>array('index')),
	array('label'=>'Manage DisciplineDocuments', 'url'=>array('admin')),
);
?>

<h1>Create DisciplineDocuments</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>