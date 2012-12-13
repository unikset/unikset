<?php
$this->breadcrumbs=array(
	'Document Tags'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DocumentTags', 'url'=>array('index')),
	array('label'=>'Manage DocumentTags', 'url'=>array('admin')),
);
?>

<h1>Create DocumentTags</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>