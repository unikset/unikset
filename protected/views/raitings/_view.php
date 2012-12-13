<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('raiting_value')); ?>:</b>
	<?php echo CHtml::encode($data->raiting_value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('insert_date')); ?>:</b>
	<?php echo CHtml::encode($data->insert_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('author_ip')); ?>:</b>
	<?php echo CHtml::encode($data->author_ip); ?>
	<br />


</div>