<?php
$this->breadcrumbs=array(
	'File Infoses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FileInfos', 'url'=>array('index')),
	array('label'=>'Create FileInfos', 'url'=>array('create')),
	array('label'=>'View FileInfos', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage FileInfos', 'url'=>array('admin')),
);
?>

<h1>Update FileInfos <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>