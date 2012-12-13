<?php
$this->breadcrumbs=array(
	'Document Comments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DocumentComments', 'url'=>array('index')),
	array('label'=>'Create DocumentComments', 'url'=>array('create')),
	array('label'=>'View DocumentComments', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DocumentComments', 'url'=>array('admin')),
);
?>

<h1>Update DocumentComments <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>