<?php
$this->breadcrumbs=array(
	Yii::t('app','Comments'),
);

$this->menu=array(
	array('label'=>Yii::t('app','Create Comments'), 'url'=>array('create')),
	array('label'=>Yii::t('app','Manage Comments'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','Comments');?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
