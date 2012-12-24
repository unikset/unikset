<?php
$this->breadcrumbs=array(
	Yii::t('app','Comments')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('app','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('app','List Comments'), 'url'=>array('index')),
	array('label'=>Yii::t('app','Create Comments'), 'url'=>array('create')),
	array('label'=>Yii::t('app','View Comment'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('app','Manage Comments'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','Update Comments');?> <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>