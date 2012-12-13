<?php
$this->breadcrumbs=array(
	'Document Tags'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DocumentTags', 'url'=>array('index')),
	array('label'=>'Create DocumentTags', 'url'=>array('create')),
	array('label'=>'View DocumentTags', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DocumentTags', 'url'=>array('admin')),
);
?>

<h1>Update DocumentTags <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>