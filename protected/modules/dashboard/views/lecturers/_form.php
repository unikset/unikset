<div class="form well">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lecturers-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="rows">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
        
        <div class="rows">
		<?php echo $form->labelEx($model,'discipline_id'); ?>
		<?php echo $form->dropDownList($model, 'discipline_id', CHtml::listData($disciplines, 'id', 'title') ); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>
        
        <div class="rows">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model, 'status', array(
                                ''=>'select',
                                '0'=>'require pre-moderation',
                                '1'=>'requires post-moderation',
                                '2'=>'approved',
                                '3'=>'deleted',
                            )
                        ); 
                ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="rows buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->