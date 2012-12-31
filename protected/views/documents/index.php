<?php
$this->breadcrumbs=array(
	Yii::t('app','Documents'),
);
?>

<h1><?php echo Yii::t('app','Documents');?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
