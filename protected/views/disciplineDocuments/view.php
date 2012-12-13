<?php
$this->breadcrumbs=array(
	'Discipline Documents'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DisciplineDocuments', 'url'=>array('index')),
	array('label'=>'Create DisciplineDocuments', 'url'=>array('create')),
	array('label'=>'Update DisciplineDocuments', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DisciplineDocuments', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DisciplineDocuments', 'url'=>array('admin')),
);
?>

<h1>View DisciplineDocuments #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'discipline_id',
		'document_id',
	),
)); ?>
