<?php foreach ($results->data as $data):?>
 
<div class="view">  
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('author_name')); ?>:</b>
	<?php echo CHtml::encode($data->author_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('link')); ?>:</b>
	<?php echo CHtml::encode($data->link); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('insert_date')); ?>:</b>
	<?php echo CHtml::encode($data->insert_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_ip')); ?>:</b>
	<?php echo CHtml::encode($data->user_ip); ?>
	<br />
        
        

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('is_university_document')); ?>:</b>
	<?php echo CHtml::encode($data->is_university_document); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>
<?php   endforeach;?>