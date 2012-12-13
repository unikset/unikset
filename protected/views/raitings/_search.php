<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'raiting_value'); ?>
		<?php echo $form->textField($model,'raiting_value'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'insert_date'); ?>
		<?php echo $form->textField($model,'insert_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'author_ip'); ?>
		<?php echo $form->textField($model,'author_ip',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->