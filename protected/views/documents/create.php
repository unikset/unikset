<?php
$this->breadcrumbs=array(
	Yii::t('app','Documents') => array('index'),
	Yii::t('app','Create'),
);
?>

<div class="pagetitle">
    <h1><?php echo Yii::t('app','Create Documents');?></h1>
</div>
<div class="page-container">
    <?php echo $this->renderPartial('_create', array('model'=>$model)); ?>
</div>