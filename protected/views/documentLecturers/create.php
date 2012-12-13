<?php
$this->breadcrumbs=array(
	'Document Lecturers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DocumentLecturers', 'url'=>array('index')),
	array('label'=>'Manage DocumentLecturers', 'url'=>array('admin')),
);
?>

<h1>Create DocumentLecturers</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>