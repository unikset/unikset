<?php
$this->breadcrumbs=array(
	'Document Tags'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DocumentTags', 'url'=>array('index')),
	array('label'=>'Create DocumentTags', 'url'=>array('create')),
	array('label'=>'Update DocumentTags', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DocumentTags', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DocumentTags', 'url'=>array('admin')),
);
?>

<h1>View DocumentTags #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'tag_id',
		'document_id',
	),
)); ?>
