<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_profile')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_profile), array('view', 'id'=>$data->id_profile)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('university_id')); ?>:</b>
	<?php echo CHtml::encode($data->university_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />


</div>