<?php
$this->breadcrumbs=array(
	'Lecturers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Lecturers', 'url'=>array('index')),
	array('label'=>'Manage Lecturers', 'url'=>array('admin')),
);
?>

<p class="lead well well-small">Create Lecturers</p>

<?php echo $this->renderPartial('_form', array(
    'model'=>$model,
    'disciplines'=>$disciplines,
    )); ?>