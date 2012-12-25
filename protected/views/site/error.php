<?php
$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<div class="pagetitle"><h2>Error <?php echo $code; ?></h2></div>
<div class="page-container">

<div class="error">
<?php echo CHtml::encode($message); ?>
</div>
</div>