<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'documents-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Yii::t('app','Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255, 'class'=>'validate[required]')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>1000, 'class'=>'validate[required]')); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'author_name'); ?>
		<?php echo $form->textField($model,'author_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'author_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'file_info_id'); ?>
		<?php echo $form->textField($model,'file_info_id'); ?>
		<?php echo $form->error($model,'file_info_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'insert_date'); ?>
		<?php echo $form->textField($model,'insert_date'); ?>
		<?php echo $form->error($model,'insert_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_ip'); ?>
		<?php echo $form->textField($model,'user_ip',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'user_ip'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_university_document'); ?>
		<?php echo $form->textField($model,'is_university_document'); ?>
		<?php echo $form->error($model,'is_university_document'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->