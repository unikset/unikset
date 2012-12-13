<?php
$this->breadcrumbs=array(
	'University Documents'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UniversityDocuments', 'url'=>array('index')),
	array('label'=>'Create UniversityDocuments', 'url'=>array('create')),
	array('label'=>'Update UniversityDocuments', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UniversityDocuments', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UniversityDocuments', 'url'=>array('admin')),
);
?>

<h1>View UniversityDocuments #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'document_id',
		'university_id',
	),
)); ?>
