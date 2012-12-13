<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comments-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textField($model,'comment',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'insert_date'); ?>
		<?php echo $form->textField($model,'insert_date'); ?>
		<?php echo $form->error($model,'insert_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'author_ip'); ?>
		<?php echo $form->textField($model,'author_ip',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'author_ip'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->