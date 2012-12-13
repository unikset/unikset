<?php
$this->breadcrumbs=array(
	'File Infoses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FileInfos', 'url'=>array('index')),
	array('label'=>'Manage FileInfos', 'url'=>array('admin')),
);
?>

<h1>Create FileInfos</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>