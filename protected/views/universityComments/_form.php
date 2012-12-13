<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'university-comments-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'comment_id'); ?>
		<?php echo $form->textField($model,'comment_id'); ?>
		<?php echo $form->error($model,'comment_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'university_id'); ?>
		<?php echo $form->textField($model,'university_id'); ?>
		<?php echo $form->error($model,'university_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->