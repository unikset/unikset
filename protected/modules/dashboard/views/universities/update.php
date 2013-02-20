<?php
$this->breadcrumbs=array(
	'Universities'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Universities', 'url'=>array('index')),
	array('label'=>'Create Universities', 'url'=>array('create')),
	array('label'=>'View Universities', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Universities', 'url'=>array('admin')),
);
?>

<p class="lead well well-small">Update Universities <?php echo $model->title; ?></p>

<?php echo $this->renderPartial('_update_form', array('model'=>$model, 'country'=>$country,)); ?>