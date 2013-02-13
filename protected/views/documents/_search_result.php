<?php if(!$results->data):?>
<h2>No results</h2>
<?php else:?>
<?php foreach ($results->data as $data):?>
 
<div class="view"> 
	<div class="doc-title"><?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id'=>$data->id)); ?></div>


	<div class="doc-description"><?php echo CHtml::encode($data->description); ?></div>
        <hr>
        
        <div class="doc-author">
            <b><?php echo CHtml::encode($data->getAttributeLabel('author_name')); ?>:</b>
            <?php echo CHtml::encode($data->author_name); ?>
        </div>

        <div class="doc-date">
            <b><?php echo CHtml::encode($data->getAttributeLabel('insert_date')); ?>:</b>
            <?php echo CHtml::encode($data->insert_date); ?>
        </div>

        
        

        <?php if($data->link):?>
	<?php //echo CHtml::encode($data->link); ?>
	<?php endif;?>

</div>
<?php   endforeach;?>
<?php endif;?>