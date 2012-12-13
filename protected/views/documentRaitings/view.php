<?php
$this->breadcrumbs=array(
	'Document Raitings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DocumentRaitings', 'url'=>array('index')),
	array('label'=>'Create DocumentRaitings', 'url'=>array('create')),
	array('label'=>'Update DocumentRaitings', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DocumentRaitings', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DocumentRaitings', 'url'=>array('admin')),
);
?>

<h1>View DocumentRaitings #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'raiting_id',
		'document_id',
	),
)); ?>
