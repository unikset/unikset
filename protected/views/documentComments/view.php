<?php
$this->breadcrumbs=array(
	'Document Comments'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DocumentComments', 'url'=>array('index')),
	array('label'=>'Create DocumentComments', 'url'=>array('create')),
	array('label'=>'Update DocumentComments', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DocumentComments', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DocumentComments', 'url'=>array('admin')),
);
?>

<h1>View DocumentComments #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'comment_id',
		'document_id',
	),
)); ?>
