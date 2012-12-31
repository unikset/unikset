<?php
$this->pageTitle=Yii::app()->name . ' - ' . Yii::t('app','Error');
$this->breadcrumbs=array(
	Yii::t('app','Error'),
);
?>

<div class="pagetitle"><h2><?php echo Yii::t('app', 'Error');?> <?php echo $code; ?></h2></div>
<div class="page-container">

<div class="error">
<?php echo CHtml::encode($message); ?>
</div>
</div>