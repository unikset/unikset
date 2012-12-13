<?php 
$this->breadcrumbs=array(
	'Locations'=>array('index'),
	'Import from CSV',
);

$this->menu=array(
	array('label'=>'List Locations', 'url'=>array('index')),
	array('label'=>'Create Locations', 'url'=>array('create')),
        array('label'=>'Import from CSV', 'url'=>array('importCsv')),
);
?>
<div class="form">
<?php echo CHtml::form('', 'post', array('enctype'=>'multipart/form-data'));?>

<div class="row">
      <?php echo CHtml::label('Select to file csv', 'csvfile'); ?>
      <?php echo CHtml::fileField('csvfile', 'Select your file...', array('size'=>60,'maxlength'=>255)); ?>
</div>
    
<div class="row buttons">
      <?php echo CHtml::submitButton($model->isNewRecord ? 'Upload' : 'Upload'); ?>
</div>
    
    
<?php echo CHtml::endForm(); ?>

</div><!-- form -->
