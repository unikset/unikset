<?php
$this->breadcrumbs=array(
	'Document Raitings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DocumentRaitings', 'url'=>array('index')),
	array('label'=>'Create DocumentRaitings', 'url'=>array('create')),
	array('label'=>'View DocumentRaitings', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DocumentRaitings', 'url'=>array('admin')),
);
?>

<h1>Update DocumentRaitings <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>