<?php
$this->breadcrumbs=array(
	Yii::t('app','Comments')=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('app','List Comments'), 'url'=>array('index')),
	array('label'=>Yii::t('app','Create Comments'), 'url'=>array('create')),
	array('label'=>Yii::t('app','Update Comments'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('app','Delete Comments'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app','Manage Comments'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','View Comments');?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'comment',
		'insert_date',
		'author_ip',
	),
)); ?>
