<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'university-documents-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'document_id'); ?>
		<?php echo $form->textField($model,'document_id'); ?>
		<?php echo $form->error($model,'document_id'); ?>
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