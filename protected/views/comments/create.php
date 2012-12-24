<?php
$this->breadcrumbs=array(
	Yii::t('app','Comments')=>array('index'),
	Yii::t('app','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('app','List Comments'), 'url'=>array('index')),
	array('label'=>Yii::t('app','Manage Comments'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','Create Comments');?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>