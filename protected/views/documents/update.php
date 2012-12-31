<?php
$this->breadcrumbs=array(
	Yii::t('app','Documents') => array('index'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('app','Update'),
);
?>

<h1><?php echo Yii::t('app','Update Documents');?> <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>