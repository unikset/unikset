<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('document_id')); ?>:</b>
	<?php echo CHtml::encode($data->document_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('university_id')); ?>:</b>
	<?php echo CHtml::encode($data->university_id); ?>
	<br />


</div>