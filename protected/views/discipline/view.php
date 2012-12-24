<?php
$this->breadcrumbs=array(
	Yii::t('app','Disciplines')=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>Yii::t('app','List Discipline'), 'url'=>array('index')),
	array('label'=>Yii::t('app','Create Discipline'), 'url'=>array('create')),
	array('label'=>Yii::t('app','Update Discipline'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('app','Delete Discipline'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app','Manage Discipline'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','View Discipline');?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
	),
)); ?>
