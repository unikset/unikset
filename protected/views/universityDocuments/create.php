<?php
$this->breadcrumbs=array(
	'University Documents'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UniversityDocuments', 'url'=>array('index')),
	array('label'=>'Manage UniversityDocuments', 'url'=>array('admin')),
);
?>

<h1>Create UniversityDocuments</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>